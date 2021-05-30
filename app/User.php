<?php

namespace App;

use App\Product;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\DatabaseUserNotification;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
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
        return $this->hasMany(Transaction::class);
    }
    public function manyNotReviewed(Product $product)
    {
        $manyHaveBuyed = 0;
        $manyHaveReviewed = 0;
        $doHaveBuyed = false;
        foreach ($this->transactions->where('status', 'success') as $transaction) {
            foreach ($transaction->detail_transaksi as $det_transaksi) {
                if ($det_transaksi->product_id == $product->id) {
                    $doHaveBuyed = true;
                } else {
                    $doHaveBuyed = false;
                }
                break;
            }
            if ($doHaveBuyed) {
                $manyHaveBuyed++;
            }
        }
        foreach ($this->reviews->where('product_id', $product->id) as $review) {
            $manyHaveReviewed++;
        }
        $notReviewed = $manyHaveBuyed - $manyHaveReviewed;
        return $notReviewed;
    }
    public function alreadyReviewed($product_id)
    {
        $alrReviewd = false;
        foreach ($this->reviews as $review) {
            if ($review->product_id == $product_id) {
                $alrReviewd = true;
                break;
            } else {
                continue;
            }
        }
        return $alrReviewd;
    }
    public function checkIfSameProductInCart($product_id)
    {
        return $this->carts->where('status', 'notyet')->where('product_id', $product_id)->first();
    }
    public function notifications()
    {
        return $this->morphMany(DatabaseUserNotification::class, 'notifiable')->orderBy('created_at');
    }
}
