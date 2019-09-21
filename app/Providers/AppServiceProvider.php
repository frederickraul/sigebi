<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use View;
use App\Log;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Schema::defaultStringLength(191);
         View::composer('layouts.admin', function ($view) {
        $view->with('logs', \App\Log::OrderBy('status','desc')->OrderBy('created_at','desc')->take(3)->get());
        $view->with('logscount', count(\App\Log::where('status',1)->OrderBy('created_at','desc')->get()));

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
