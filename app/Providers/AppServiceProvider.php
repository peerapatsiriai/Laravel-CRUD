<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
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
       

        View::composer(['login', 'register', 'product', 'createproduct', 'editproduct'], function ($view) {
            $view->with('alert', 'components.alert');
        });
        
        View::composer(['product', 'createproduct', 'editproduct'], function ($view) {
            $username = Auth::user()->name;
            $view->with('header', 'components.header')->with('username', $username);
        });
    }
}
