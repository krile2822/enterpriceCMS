<?php

namespace CMS\PayPal;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        // Variables shared with all the views
        // view()->composer('*', function($view) {
        //    $view->with('menu', Menu::getMenu());
        //    $view->with('users', User::getUsers());
        //    $view->with('pages', Page::getPages());
        //    $view->with('articles', Article::getArticles());
        // });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
