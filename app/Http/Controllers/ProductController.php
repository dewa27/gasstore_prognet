<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductCategory;
use App\ProductCategoryDetails;
use App\ProductImages;

use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    //
    public function index()
    {
        $products = Product::all();
        $categories = ProductCategory::all();
        return view('product.index', compact('products', 'categories'));
    }
    public function show(Product $product)
    {
        // dd($product->id);
        return view('product.show', compact('product'));
    }
    public function create()
    {
        $categories = ProductCategory::all();
        return view('product.create', compact('categories'));
    }
    public function store(Request $request)
    {
        $val = $request->validate([
            'product_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'category_id' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg',
        ], [
            'product_name.required' => "Nama produk harus diisi!",
            'price.required' => "Harga Produk harus diisi!",
            'description.required' => "Deskripsi harus diisi!",
            'stock.required' => "Stok Produk harus diisi!",
            'stock.numeric' => "Stok Produk berupa angka!",
            'weight.required' => "Berat Produk harus diisi!",
            'weight.numeric' => "Berat Produk berupa angka!",
            'category_id.required' => 'Kategori harus dipilih',
            'product_images.*.mimes' => 'File hanya berupa foto',
        ]);
        $val['price'] = preg_replace('/[^0-9]/', '', $val['price']);
        //Store produk ke products
        $product = Product::create($val);
        //Ambil input categories
        $categories = $request->input('category_id');
        //Store categories ke product_categories
        foreach ((array) $categories as $category_id) {
            $product->attach($category_id);
        }
        //Ambil input images
        $images = $request->file('product_images');
        // dd($images);
        //Menyimpan foto
        foreach ((array)$images as $image) {
            $sourceName = $image->getClientOriginalName();
            $name = $product->id . '-' . $sourceName;
            $image->move('images/products/', $name);
            ProductImages::create([
                'product_id' => $product->id,
                'image_name' => $name,
            ]);
        }
        // session()->flash('success', 'Post telah dibuat!');
        return redirect('admin/products/' . $product->id . '/detail');
    }
    public function edit(Product $product)
    {
        // dd($product->id);
        $categories = ProductCategory::all();
        $categories_id = ProductCategory::all('id')->toArray();
        // dd($categories);
        return view('product.edit', compact('product', 'categories', 'categories_id'));
    }
    public function update(Product $product)
    {
        $val = request()->validate([
            'product_name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required|numeric',
            'weight' => 'required|numeric',
            'category_id' => 'required',
            'product_images.*' => 'image|mimes:jpeg,png,jpg',
        ], [
            'product_name.required' => "Nama produk harus diisi!",
            'price.required' => "Harga Produk harus diisi!",
            'description.required' => "Deskripsi harus diisi!",
            'stock.required' => "Stok Produk harus diisi!",
            'stock.numeric' => "Stok Produk berupa angka!",
            'weight.required' => "Berat Produk harus diisi!",
            'weight.numeric' => "Berat Produk berupa angka!",
            'category_id.required' => 'Kategori harus dipilih',
            'product_images.*.mimes' => 'File hanya berupa foto',
        ]);
        $val['price'] = preg_replace('/[^0-9]/', '', $val['price']);
        $product->update($val);
        //Update categories
        $categories = request()->input('category_id');
        $product->categories()->sync($categories);
        //Logika masukin many to many sebelum tau sync
        // dd($categories);
        // $pro_categories = $product->categories;
        // $pro_categories_id = [];
        // foreach ($pro_categories as $category) {
        //     array_push($pro_categories_id, $category->id);
        //     if (!in_array($category->id, $categories)) {
        //         $cat = ProductCategoryDetails::where('product_id', $product->id)->where('category_id', $category->id)->delete();
        //     }
        // }
        // foreach ((array) $categories as $category_id) {
        //     if (!in_array($category_id, $pro_categories_id)) {
        //         ProductCategoryDetails::create([
        //             'product_id' => $product->id,
        //             'category_id' => $category_id,
        //         ]);
        //     }
        // }


        //Menghapus images yang dihapus
        $delImagesId = request()->input('deletedImagesId');
        if (!empty($delImagesId)) {
            $deletedImagesArr = explode(',', $delImagesId);
            foreach ($deletedImagesArr as $id) {
                ProductImages::find($id)->delete();
            }
        }
        //Ambil input images tambahan
        $images = request()->file('product_images');
        // dd($images);
        //Menyimpan foto
        foreach ((array)$images as $image) {
            $sourceName = $image->getClientOriginalName();
            $name = $product->id . '-' . $sourceName;
            $image->move('images/products/', $name);
            ProductImages::create([
                'product_id' => $product->id,
                'image_name' => $name,
            ]);
        }
        return redirect('admin/products/' . $product->id . '/detail');
    }
    public function delete(Product $product)
    {
        $product->delete();
        // session()->flash('success', 'Post telah dihapus');
        return redirect('admin/products');
    }
    public function search(Request $request)
    {
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
        // dd($result->chunk(5));
        // dd($result->forPage(0, 3)->keys());
        // dd($result);
        // // return $result->paginate(3)->toJson();
        // return $tes->toJson();
        return json_encode($result);
    }
    public function trash()
    {
        $products = Product::onlyTrashed()->get();
        return view('product.trash', compact('products'));
    }
    public function trashTheTrashed($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->forceDelete();
        return redirect('/admin/products/trashed');
    }
    public function restore($id)
    {
        $product = Product::withTrashed()->findOrFail($id);
        $product->restore();
        return redirect('/admin/products/trashed');
    }
}
