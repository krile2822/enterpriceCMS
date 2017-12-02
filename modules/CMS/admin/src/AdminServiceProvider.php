<?php

namespace CMS\admin;

use Illuminate\Support\ServiceProvider;


class AdminServiceProvider extends ServiceProvider
{
	public function boot() {
		// Include routes file
		include __DIR__ . '/Routes/web.php';

		// Include View folder within all files
		// reference name => 'admin'
		$this->loadViewsFrom(__DIR__ . '/Views', 'admin');

		//file to be published
		$this->publishes([
			__DIR__ . '/Config/theme.php' => base_path('config/theme.php'),
		]);
	}

	public function register() {

		//create admin "instance"
		$this->app->bind('admin', function($app) {
			return new admin;
		});

	}
}
