<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    protected $fillable = ['courier'];
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
