<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransactionDetail extends Model
{
    protected $table = "transaction_details";
    protected $fillable = ['transaction_id', 'product_id', 'qty', 'discount', 'selling_price'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function transaksi()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'id');
    }
}
