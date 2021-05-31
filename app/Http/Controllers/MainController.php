<?php

namespace App\Http\Controllers;

use App\Cart;
use App\City;
use App\Courier;
use App\Notifications\AdminNotification;
use App\Product;
use App\ProductCategory;
use App\ProductCategoryDetails;
use App\ProductImages;
use App\Province;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use App\Review;
use App\Transaction;
use App\TransactionDetail;
use Illuminate\Support\Facades\Date;
use Psy\Readline\Transient;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Admin;
use App\DatabaseUserNotification;
use App\Response;

class MainController extends Controller
{
    public function index()
    {
        return view('main.index');
    }
    public function products()
    {
        $products = Product::all();
        $product = Product::find(1);
        $categories = ProductCategory::all();
        // dd($product->images->first()->image_name);
        return view('main.products', compact('products', 'categories'));
    }
    public function product(Product $product)
    {
        $similar_products = collect([]);
        foreach ($product->categories as $category) {
            $products_cat = ProductCategory::find($category->id)->products;
            $similar_products = $similar_products->merge($products_cat);
        }
        $similar_products = $similar_products->where('id', '!=', $product->id)->take(10);
        // dd($similar_products);
        return view('main.product', compact('product', 'similar_products'));
    }
    public function search(Request $request)
    {
        $data = [];
        $productImage = [];
        $productCategory = [];
        $categories = $request->input('category_id');
        $keyword = $request->input('keyword');
        $all_products = collect([]);
        if (!is_null($categories)) {
            foreach ((array) $categories as $key => $category_id) {
                if ($key == 0) {
                    $all_products = ProductCategory::find($category_id)->products;
                } else {
                    $products_cat = ProductCategory::find($category_id)->products;
                    $all_products = $all_products->merge($products_cat);
                }
            }
        }
        //Keyword dan kategori kosong atau keyword isi tapi kategori kosong
        if ((is_null($keyword) && is_null($categories)) || (!is_null($keyword) && is_null($categories))) {
            $result = Product::where('product_name', 'like', "%" . $keyword . '%')->get();
        } else if (is_null($keyword) && !is_null($categories)) { //keyword kosong tapi kategori isi
            $result = $all_products;
        } else { //keyword isi dan kategori isi
            $result = $all_products->filter(function ($product) use ($keyword) {
                return false !== stristr($product->product_name, $keyword);
            })->values();
        }

        foreach ($result as $product) {
            if (is_null($product->images->first())) {
                array_push($productImage, null);
            } else {
                array_push($productImage, $product->images->first()->image_name);
            }
            $categoryArr = [];
            foreach ($product->categories as $category) {
                array_push($categoryArr, $category->id);
            }
            array_push($productCategory, $categoryArr);
        }
        // dd($productCategory);
        // dd($productImage);
        // dd(json_encode($result));
        // dd($result->chunk(5));
        // dd($result->forPage(0, 3)->keys());
        return json_encode($result->toArray());
    }
    public function cart()
    {
        $carts = Auth::user()->carts->where('status', 'notyet');
        $total = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->getPriceOrDiscountedPrice() * $cart->qty;
        }
        return view('user.cart', compact('carts', 'total'));
    }
    public function deleteCart(Cart $cart)
    {
        $cart->delete();
        // session()->flash('success', 'Post telah dihapus');
        return redirect()->back();
    }
    public function checkout()
    {
        $carts = Auth::user()->carts->where('status', 'notyet');
        $couriers = Courier::all();
        $total = 0;
        $weight = 0;
        foreach ($carts as $cart) {
            $total += $cart->product->getPriceOrDiscountedPrice() * $cart->qty;
            $weight += $cart->product->weight * $cart->qty;
        }
        $daftarProvinsi = Province::all();
        return view('user.checkout', compact('carts', 'total', 'daftarProvinsi', 'weight', 'couriers'));
    }
    public function postCheckout()
    {
        $carts = Auth::user()->carts->where('status', 'notyet');
        $val = request()->validate([
            'province' => 'required',
            'regency' => 'required',
            'address' => 'required',
            'sub_total' => 'required',
        ], [
            'province.required' => "Provinsi harus dipilih!",
            'regency.required' => "Kota harus diisi!",
            'address.required' => 'Harap masukkan alamat lengkap',
        ]);
        $courier = Courier::where('courier', request()->input('courier_id'))->get();
        $val['timeout'] = Carbon::now()->addDays(1);
        $val['user_id'] = Auth::user()->id;
        $val['courier_id'] = $courier[0]->id;
        $val['status'] = "unverified";
        $val['shipping_cost'] = request()->input('shipping_cost');
        $val['total'] = $val['sub_total'] + $val['shipping_cost'];
        $val['sub_total'] = $val['sub_total'];
        $val['province'] = Province::where('province_id', $val['province'])->get()[0]->title;
        $val['regency'] = City::where('city_id', $val['regency'])->get()[0]->title;
        $transaction = Transaction::create($val);
        foreach ($carts as $cart) {
            if ($cart->product->getActiveDiscount()) {
                $discount = $cart->product->getActiveDiscount()->percentage;
            } else {
                $discount = NULL;
            }
            $price = $cart->product->getPriceOrDiscountedPrice();
            TransactionDetail::create([
                'transaction_id' => $transaction->id,
                'product_id' => $cart->product_id,
                'qty' => $cart->qty,
                'discount' => $discount,
                'selling_price' => $price,
            ]);
            $cart->update(['status' => 'checkedout']);
        }
        $admin = Admin::find(2);
        Notification::send($admin, new AdminNotification(0, $transaction, null, 'transaction'));
        return redirect()->to('/transaksi/' . $transaction->id . '/detail');
    }
    public function instant_checkout()
    {
        $product_id = request()->input('product_id');
        $qty = request()->input('qty');
        $couriers = Courier::all();
        $product = Product::find($product_id);
        $daftarProvinsi = Province::all();
        return view('user.instant_checkout', compact('couriers', 'qty', 'daftarProvinsi', 'product'));
    }
    public function product_post_checkout()
    {
        $val = request()->validate([
            'province' => 'required',
            'regency' => 'required',
            'address' => 'required',
            'sub_total' => 'required',
        ], [
            'province.required' => "Provinsi harus dipilih!",
            'regency.required' => "Kota harus diisi!",
            'address.required' => 'Harap masukkan alamat lengkap',
        ]);
        $courier = Courier::where('courier', request()->input('courier_id'))->get();
        $product_id = request()->input('product_id');
        $qty = request()->input('qty');
        $val['timeout'] = Carbon::now()->addDays(1);
        $val['user_id'] = Auth::user()->id;
        $val['courier_id'] = $courier[0]->id;
        $val['status'] = "unverified";
        $val['shipping_cost'] = request()->input('shipping_cost');
        $val['total'] = $val['sub_total'] + $val['shipping_cost'];
        $val['sub_total'] = $val['sub_total'];
        $val['province'] = Province::where('province_id', $val['province'])->get()[0]->title;
        $val['regency'] = City::where('city_id', $val['regency'])->get()[0]->title;
        $transaction = Transaction::create($val);
        TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $product_id,
            'qty' => $qty,
            'discount' => Product::find($product_id)->getActiveDiscount(),
            'selling_price' => Product::find($product_id)->getPriceOrDiscountedPrice(),
        ]);
        $admin = Admin::find(2);
        Notification::send($admin, new AdminNotification(0, $transaction, null, 'transaction'));
        return redirect()->to('/transaksi/' . $transaction->id . '/detail');
    }
    public function detail_transaksi(Transaction $transaction)
    {
        if (Auth::user()->id == $transaction->user_id) {
            $detail_transaksi = \App\TransactionDetail::where('transaction_id', $transaction->id)->get();
            return view('user.transaksi', compact('transaction', 'detail_transaksi'));
        } else {
            return abort(404);
        }
    }
    public function post_verif_pembayaran()
    {
        $user = Auth::user();
        $proof_of_payment = request()->file('proof_of_payment');
        $id = request()->input('id');
        if (is_null($proof_of_payment)) {
            $name = null;
        } else {
            $sourceName = $proof_of_payment->getClientOriginalName();
            $name = $user->id . '-' . $sourceName;
            $proof_of_payment->move('images/verif/', $name);
        }
        $trans = Transaction::find($id);
        $trans->proof_of_payment = $name;
        $trans->save();
        $admin = Admin::find(2);
        Notification::send($admin, new AdminNotification(1, $trans, null, 'transaction'));
        return json_encode($trans);
    }
    public function update_status_transaksi(Transaction $transaction)
    {
        $status = request()->input('status');
        $transaction->update(['status' => $status]);
        if ($transaction->status == "canceled") {
            $str = "Transaksi Anda telah dibatalkan";
            $stat = 3;
        } else {
            $str = "Terima kasih telah mengkonfirmasi barang belanjaan Anda!";
            $stat = 1;
        }
        $admin = Admin::find(2);
        Notification::send($admin, new AdminNotification($stat, $transaction, null, 'transaction'));
        return redirect()->back()->with('flash', $str);
    }
    public function getCity()
    {
        $province_id = request()->input('province_id');
        $daftarKota = City::where('province_id', $province_id)->get();
        return json_encode($daftarKota);
    }
    public function getOngkir()
    {
        // $origin = request()->input('province_id');
        $destination = request()->input('city_id');
        $weight = request()->input('weight');
        $courier = request()->input('courier');
        $daftarProvinsi = RajaOngkir::ongkosKirim([
            'origin'        => 114,     // ID kota/kabupaten asal
            'destination'   => $destination,      // ID kota/kabupaten tujuan
            'weight'        => $weight,    // berat barang dalam gram
            'courier'       => $courier    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        return json_encode($daftarProvinsi[0]);
    }
    public function pembelian()
    {
        $user = Auth::user();
        $transactions = Transaction::where('user_id', $user->id)->get();
        return view('user.pembelian', compact('user', 'transactions'));
    }
    public function register()
    {
        return view('main.register');
    }
    public function user_profile()
    {
        return view('user.profile');
    }
    public function post_user_profile()
    {
        $user = Auth::user();
        $val = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|mimes:jpeg,png,jpg',
        ], [
            'name.required' => "Nama harus diisi!",
            'email.required' => "Email harus diisi!",
            'product_images.*.mimes' => 'File hanya berupa foto',
        ]);
        $image = request()->file('profile_image');
        if (is_null($image)) {
            $name = Auth::user()->profile_image;
        } else {
            $sourceName = $image->getClientOriginalName();
            $name = $user->id . '-' . $sourceName;
            $image->move('images/', $name);
        }
        $val['profile_image'] = $name;
        $user->update($val);
        return redirect()->back();
    }
    public function addToCart()
    {
        $product_id = request()->input('product_id');
        $qty = request()->input('qty');
        $cart = Auth::user()->checkIfSameProductInCart($product_id);
        if ($cart) {
            $new_qty = $cart->qty + $qty;
            $cart->update(['qty' => $new_qty]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'product_id' => $product_id,
                'qty' => $qty,
                'status' => 'notyet',
            ]);
        }
        return redirect()->back()->with('flash', 'Produk telah berhasil ditambahkan ke cart');
    }
    public function updateCart(Request $request)
    {
        $id = $request->input('cart_id');
        $qty = $request->input('qty');
        $cart = Cart::find($id);
        $cart->update(['qty' => $qty]);
    }
    public function user_send_review()
    {
        $val = request()->validate([
            'content' => 'required'
        ], [
            'content.required' => "Balasan terhadap review harus diisi!"
        ]);
        $val['rate'] = request()->input('rate');
        $val['product_id'] = request()->input('product_id');
        ///------GANTI USER ID INGET KALO MOD 1 UDAH SELESAI
        $val['user_id'] = Auth()->user()->id;
        // dd($val);
        $review = Review::create($val);
        $admin = Admin::find(2);
        $trans = new Transaction();
        Notification::send($admin, new AdminNotification(null, $trans, $review, 'review'));
        return back();
    }
    public function baca_notif()
    {
        $val = [];
        $val['id'] = (int)request()->input('notification_id');
        $trans_id = request()->input('transaction_id');
        $response = Response::find((int)request()->input('response_id'));
        $val['read_at'] = now()->toDateTimeString();
        $notif = DatabaseUserNotification::find($val['id']);
        $notif->update($val);
        if ($trans_id != null) {
            return redirect()->to('/transaksi/' . $trans_id . '/detail');
        } else {
            return redirect()->to('/products/' . $response->review->product->id . '/detail')->with('scroll_response', 'response' . $response->id);
        }
    }
}
