<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'product_reviews';
    protected $fillable = ['product_id', 'user_id', 'rate', 'content'];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function responses()
    {
        return $this->hasMany(Response::class);
    }
}
