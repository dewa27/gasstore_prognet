<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $fillable = ['product_id', 'percentage', 'start', 'end'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
