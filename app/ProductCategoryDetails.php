<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategoryDetails extends Model
{
    protected $fillable = ['product_id', 'category_id'];
}
