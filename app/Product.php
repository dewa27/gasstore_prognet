<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_details', 'product_id', 'transaction_id');
    }
    public function transaction_details()
    {
        return $this->hasMany(TransactionDetail::class);
    }
    public function getActiveDiscount()
    {
        if ($this->discounts()) {
            $activeDiscount = $this->discounts()->whereDate('start', '<=', date("Y-m-d"))->whereDate('end', '>=', date("Y-m-d"))->orderBy('start', 'ASC')->first();
        } else {
            $activeDiscount = NULL;
        }
        return $activeDiscount;
    }
    public function getPriceOrDiscountedPrice()
    {
        $discount = $this->getActiveDiscount();
        if ($discount != NULL) {
            $price = $this->price * (100 - $discount->percentage) / 100;
        } else {
            $price = $this->price;
        }
        return $price;
    }
}
