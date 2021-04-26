<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    protected $table = "response";
    protected $fillable = ['admin_id', 'review_id', 'content'];
    public function review()
    {
        return $this->belongsTo(Review::class, 'review_id');
    }
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }
}
