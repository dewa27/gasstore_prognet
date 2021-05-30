<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    public function login(Request $request)
    {
        // Validate form data
        $this->validate(
            $request,
            [
                'username' => 'required|string',
                'password' => 'required|string|min:8'
            ]
        );

        // Attempt to login as admin
        if (Auth::guard('admin')->attempt(['username' => $request->username, 'password' => $request->password], $request->remember)) {
            // If successful then redirect to intended route or admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        }

        // If unsuccessful then redirect back to login page with username and remember fields
        return redirect()->back()->withInput($request->only('username', 'remember'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/admin');
    }
}
