<?php

namespace CMS\Front;

use Illuminate\Support\ServiceProvider;
use CMS\Front\MainMenu;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Variables shared with all blade files
        // view()->composer('*', function($view) {
        //    $view->with('main_menu', MainMenu::getMainMenu());
        //
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
