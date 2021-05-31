<?php

namespace App\Http\Controllers;

use App\DatabaseAdminNotification;
use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Date;
use App\Review;
use App\Product;
use App\User;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data_sukses_per_tahun = [];
        $data_ongoing_per_tahun = [];
        $data_cancel_per_tahun = [];
        $data_penjualan_sukses_5_tahun = [];
        $data_penjualan_ongoing_5_tahun = [];
        $data_penjualan_cancel_5_tahun = [];
        $i = 1;
        $trans_cancel = Transaction::where('status', 'canceled')->orWhere('status', 'expired')->get();
        $trans_ongoing = Transaction::where('status', 'unverified')->orWhere('status', 'verified')->orWhere('status', 'delivered')->get();
        $trans_sukses = Transaction::where('status', 'success')->get();
        for ($i = 1; $i <= 12; $i++) {
            $j = 0;
            foreach ($trans_sukses as $t) {
                $month_number = (int)date("n", strtotime($t->created_at->format('M')));
                if ($month_number == $i) {
                    $j++;
                }
            }
            array_push($data_sukses_per_tahun, $j);
        }
        for ($i = 2021; $i > 2016; $i--) {
            $j = 0;
            foreach ($trans_sukses as $t) {
                $year = (int)$t->created_at->format('Y');
                if ($year == $i) {
                    $j++;
                }
            }
            array_push($data_penjualan_sukses_5_tahun, $j);
        }
        for ($i = 1; $i <= 12; $i++) {
            $j = 0;
            foreach ($trans_ongoing as $t) {
                $month_number = (int)date("n", strtotime($t->created_at->format('M')));
                if ($month_number == $i) {
                    $j++;
                }
            }
            array_push($data_ongoing_per_tahun, $j);
        }
        for ($i = 2021; $i > 2016; $i--) {
            $j = 0;
            foreach ($trans_ongoing as $t) {
                $year = (int)$t->created_at->format('Y');
                if ($year == $i) {
                    $j++;
                }
            }
            array_push($data_penjualan_ongoing_5_tahun, $j);
        }
        for ($i = 1; $i <= 12; $i++) {
            $j = 0;
            foreach ($trans_cancel as $t) {
                $month_number = (int)date("n", strtotime($t->created_at->format('M')));
                if ($month_number == $i) {
                    $j++;
                }
            }
            array_push($data_cancel_per_tahun, $j);
        }
        for ($i = 2021; $i > 2016; $i--) {
            $j = 0;
            foreach ($trans_sukses as $t) {
                $year = (int)$t->created_at->format('Y');
                if ($year == $i) {
                    $j++;
                }
            }
            array_push($data_penjualan_cancel_5_tahun, $j);
        }
        $data_penjualan_sukses_5_tahun = array_reverse($data_penjualan_sukses_5_tahun);
        $data_penjualan_ongoing_5_tahun = array_reverse($data_penjualan_ongoing_5_tahun);
        $data_penjualan_cancel_5_tahun = array_reverse($data_penjualan_cancel_5_tahun);
        $total_produk = Product::all()->count();
        $total_transaksi = Transaction::all()->count();
        $total_user = User::all()->count();
        return view('product.dashboard', compact('total_produk', 'total_user', 'total_transaksi', 'data_sukses_per_tahun', 'data_ongoing_per_tahun', 'data_cancel_per_tahun', 'data_penjualan_sukses_5_tahun', 'data_penjualan_cancel_5_tahun', 'data_penjualan_ongoing_5_tahun'));
    }
    public function baca_notif()
    {
        $val = [];
        $val['id'] = (int)request()->input('notification_id');
        $trans_id = request()->input('transaction_id');
        $review = Review::find((int)request()->input('review_id'));
        $val['read_at'] = now()->toDateTimeString();
        $notif = DatabaseAdminNotification::find($val['id']);
        $notif->update($val);
        if ($trans_id != null) {
            return redirect()->to('/admin/transactions/' . $trans_id . '/detail');
        } else {
            return redirect()->to('/admin/products/' . $review->product->id . '/detail')->with('scroll_review', $review->id);
        }
    }
}
