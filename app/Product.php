<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_name', 'price', 'description', 'product_rate', 'stock', 'weight'];
    //
    protected $dates = ['deleted_at'];
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_category_details', 'product_id', 'category_id');
    }
    public function images()
    {
        return $this->hasMany(ProductImages::class);
    }
    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }
}
