<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['address', 'timeout', 'regency', 'province', 'total', 'sub_total', 'shipping_cost', 'user_id', 'courier_id', 'proof_of_payment', 'status'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_details', 'transaction_id', 'product_id');
    }
    public function courier()
    {
        return $this->belongsTo(Courier::class);
    }
    public function detail_transaksi()
    {
        return $this->hasMany(TransactionDetail::class, 'transaction_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    // public function province()
    // {
    //     return $this->belongsTo(Province::class);
    // }
    // public function city()
    // {
    //     return $this->belongsTo(City::class);
    // }
    // use SoftDeletes;
    // protected $fillable = ['product_name', 'price', 'description', 'product_rate', 'stock', 'weight'];
}
