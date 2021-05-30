<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout', 'userLogout');
    }

    protected function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->back()->with('success', 'your message here');;
        }
        return view('auth.login2');
    }
    public function userLogout(Request $request)
    {
        Auth::guard('web')->logout();
        return redirect('/');
        // return redirect('/')->with('success', 'Anda telah berhasil Login!');
    }
    protected function authenticated(Request $request, $user)
    {
        $request->session()->flash('flash', 'Anda berhasil login !');
        return redirect()->intended($this->redirectPath());
    }
}
