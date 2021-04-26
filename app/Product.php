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
    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'transaction_details', 'product_id', 'transaction_id');
    }
    public function haveBuyed()
    {
        $doHaveBuyed = false;
        foreach ($this->transactions as $transaction) {
            if ($transaction->user_id == Auth::user()->id) {
                $doHaveBuyed = true;
                break;
            } else {
                continue;
            }
        }
        return $doHaveBuyed;
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
}
