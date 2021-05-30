<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Response;
use App\Transaction;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserNotification;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function send_response()
    {
        $val = request()->validate([
            'content' => 'required',
        ], [
            'content.required' => "Balasan review harus diisi!",
        ]);
        $val['review_id'] = request()->input('review_id');
        $val['admin_id'] = Auth::user()->id;
        $response = Response::create($val);
        $user = Review::find($val['review_id'])->user;
        $transaction = new Transaction();
        Notification::send($user, new UserNotification($transaction, $response, "response"));
        return back();
    }
}
