<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Product;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::all();
        return view('discount.index', compact('discounts'));
    }
    public function create()
    {
        $products = Product::all();
        return view('discount.create', compact('products'));
    }
    public function store()
    {
        $val = request()->validate([
            'percentage' => 'required|numeric|min:1|max:99',
            'product_id' => 'required',
            'start' => 'required|date|before:end|after:yesterday',
            'end' => 'required|date|after:start',
        ], [
            'percentage.required' => "Persentase diskon harus diisi!",
            'percentage.numeric' => "Persentase diskon sudah berupa angka!",
            'percentage.min' => "Persentase diskon minimal 1!",
            'percentage.max' => "Persentase diskon maksimal 99!",
            'product_id.required' => "Produk harus dipilih!",
            'start.required' => "Tanggal mulainya diskon harus diisi!",
            'start.before' => "Tanggal mulainya diskon tidak valid!",
            'start.after' => "Tanggal mulainya diskon sudah lewat!",
            'end.required' => "Tanggal berakhirnya diskon harus diisi!",
            'end.after' => "Tanggal berakhirnya diskon tidak valid!",
        ]);
        $cat = Discount::create($val);
        return redirect('admin/discounts');
    }
}
