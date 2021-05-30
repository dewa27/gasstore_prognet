<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        // $transactions = Transaction::all();
        $users = User::all();
        return view('useradmin.index', compact('users'));
    }
    public function login()
    {
        return view('auth.login');
    }
}
