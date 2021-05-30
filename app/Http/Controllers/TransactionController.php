<?php

namespace App\Http\Controllers;

use App\Notifications\UserNotification;
use App\Response;
use Illuminate\Http\Request;
use App\Transaction;
use Illuminate\Support\Facades\Notification;
use App\User;
use App\Product;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $transactions = Transaction::all();
        return view('transaction.index', compact('transactions'));
    }
    public function show(Transaction $transaction)
    {
        return view('transaction.show', compact('transaction'));
    }
    public function updateStatus()
    {
        $status = request()->input('status');
        $transaction = Transaction::find(request()->input('id'));
        $transaction->update(['status' => $status]);
        $user = User::find($transaction->user_id);
        $response = new Response();
        Notification::send($user, new UserNotification($transaction, $response, "transaction"));
        if ($status == "verified") {
            foreach ($transaction->detail_transaksi as $det_transaksi) {
                $product = Product::find($det_transaksi->product_id);
                $product->update(["stok" => $product->stock - $det_transaksi->qty]);
            }
        }
        return redirect('/admin/products');
    }
}
