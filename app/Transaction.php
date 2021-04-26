<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['address', 'regency', 'province', 'total', 'shipping_cost', 'user_id', 'courier_id', 'proof_of_payment', 'status'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_details', 'transaction_id', 'product_id');
    }
    // use SoftDeletes;
    // protected $fillable = ['product_name', 'price', 'description', 'product_rate', 'stock', 'weight'];
}
