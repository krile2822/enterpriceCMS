<?php

namespace CMS\Contact;

use Illuminate\Support\ServiceProvider;


class ContactServiceProvider extends ServiceProvider
{
	public function boot() {
		// Include routes file
		include __DIR__ . '/Routes/web.php';

		// Include View folder within all files
		// reference name => 'contact'
		$this->loadViewsFrom(__DIR__ . '/Views', 'Contact');

		//file to be published
		// $this->publishes([
		// 	__DIR__ . '/Config/theme.php' => base_path('config/theme.php'),
		// ]);
	}

	public function register() {

		//create contact "instance"
		$this->app->bind('contact', function($app) {
			return new Contact;
		});

	}
}
