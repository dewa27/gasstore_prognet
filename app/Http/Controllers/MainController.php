<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductCategoryDetails;
use App\ProductImages;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use App\Review;

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
        $cart = "adas";
        return view('main.cart', compact('cart'));
    }
    public function login()
    {
        return view('main.login');
    }
    public function register()
    {
        return view('main.register');
    }
    public function user_profile()
    {
        $user = Auth::user();
        return view('main.profile', compact('user'));
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
        $val['user_id'] = 1;
        // dd($val);
        Review::create($val);
        return back();
    }
}
