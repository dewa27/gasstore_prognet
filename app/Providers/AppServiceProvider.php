<?php

namespace App\Providers;

use App\DatabaseAdminNotification;
use App\DatabaseUserNotification;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Carbon;
use Illuminate\View\View as ViewView;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layouts.adminmaster', function (ViewView $view) {
            $notif = DatabaseAdminNotification::where('read_at', null)->orderBy('created_at', 'desc')->get();
            $view->with('notif', $notif);
        });
        // dd(Auth::check());
        // if (!is_null(Auth::user()->id)) {
        view()->composer('layouts.master', function (ViewView $view) {
            if (!is_null(Auth::user())) {
                $notif = DatabaseUserNotification::where('read_at', null)->where('notifiable_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
                $view->with('notif', $notif);
            }
        });
        // }
        Schema::defaultStringLength(191);
    }
}
