<?php

namespace CMS\Front;

use Illuminate\Support\ServiceProvider;


class FrontServiceProvider extends ServiceProvider
{
	public function boot() {

		$locales = $this->app->config->get('app.locales');

		// Load route resources 
		if (count($locales) > 1) {
				include __DIR__ . '/Routes/web.php';
		} else {
				include __DIR__ . '/Routes/web_one_lang.php';
		}

		// Load the views form..
		$this->loadViewsFrom(__DIR__ . '/Views', 'front');
	}

	public function register() {

		// Create front instance
		$this->app->bind('front', function($app) {
			return new front;
		});

	}
}
