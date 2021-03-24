<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImages extends Model
{
    protected $fillable = ['product_id', 'image_name'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
