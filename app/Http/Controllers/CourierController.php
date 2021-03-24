<?php

namespace App\Http\Controllers;

use App\Courier;
use Illuminate\Http\Request;

class CourierController extends Controller
{
    public function index()
    {
        $couriers = Courier::all();
        return view('courier.index', compact('couriers'));
    }
    public function show(Courier $courier)
    {
        return view('courier.show', compact('courier'));
    }
    public function create()
    {
        return view('courier.create');
    }
    public function store()
    {
        $val = request()->validate([
            'courier' => 'required|unique:couriers',
        ], [
            'courier.required' => 'Nama Kurir harus diisi!',
            'courier.unique' => 'Kurir sudah terdaftar!',
        ]);
        Courier::create($val);
        return redirect('admin/couriers');
    }
    public function delete(Courier $courier)
    {
        $courier->delete();
        return redirect('admin/couriers');
    }
}
