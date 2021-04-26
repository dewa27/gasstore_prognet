<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Review;
use App\Response;

class ReviewController extends Controller
{
    public function send_response()
    {
        $val = request()->validate([
            'content' => 'required',
        ], [
            'content.required' => "Balasan review harus diisi!",
        ]);
        $val['review_id'] = request()->input('review_id');
        ///------GANTI ADMIN ID INGET KALO MOD 1 UDAH SELESAI
        $val['admin_id'] = 1;
        Response::create($val);
        return back();
    }
}
