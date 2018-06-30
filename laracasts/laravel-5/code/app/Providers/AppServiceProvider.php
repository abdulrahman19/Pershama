<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    //protected $defer = true; // that's mean you can (defer) load this classes to call only when use
    // use it if you register things

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('posts.sidebar', function ($view) {
            $view->with('archive', \App\Post::archives());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //=> to use factory DP
        // APP::bind('App\Bla', function () {
        //     return new \App\Bla(config('services.stripe.secret'));
        // });

        // or here you can use
        // $this->app->bind('App\Bla', function ($app) { // you can resolve other things here or pass var
        //     return new \App\Bla(config('services.stripe.secret'));
        // });

        // // to use it later

        // $srtipe = App::make('App\Bla');
        // // now it'll create a new instance form the class bla without know what happened in a creation level

        //=> to use singleton DP
        // App::singleton()
    }
}
