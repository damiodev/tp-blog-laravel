<?php

namespace App\Providers;

use App\Http\View\Home;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        View::composer(['front.layout', 'front.index'], function ($view) {
            $view->with([
                'categories' => \App\Models\Category::has('posts')->get(),
            ]);
        });
    }
}
