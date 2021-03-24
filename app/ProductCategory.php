<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['category_name'];
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_category_details', 'category_id', 'product_id');
    }
}
