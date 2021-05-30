<?php

namespace App\Http\Controllers;

use App\ProductCategory;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {

        $categories = ProductCategory::all();
        return view('category.index', compact('categories'));
    }
    public function create()
    {
        return view('category.create');
    }
    public function store()
    {
        $val = request()->validate([
            'category_name' => 'required|unique:product_categories',
        ], [
            'category_name.required' => "Kategori produk harus diisi!",
            'category_name.unique' => "Kategori produk sudah ada!",
        ]);
        $cat = ProductCategory::create($val);
        return redirect('admin/categories');
    }
    public function show(ProductCategory $product_category)
    {
        return view('category.show', compact('product_category'));
    }
    public function delete(ProductCategory $product_category)
    {
        $product_category->delete();
        // session()->flash('success', 'Post telah dihapus');
        return redirect('admin/categories');
    }
}
