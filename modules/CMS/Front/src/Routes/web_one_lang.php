<?php

/*******************************************************************************
   Route web file that contains all the routes for the frontend
*******************************************************************************/
Route::group(['namespace' => 'CMS\Front\Controllers', 'middleware' => ['web']], function () {
		// Route::get('/', [
		// 	'as' => 'welcome',
		// 	'uses' => 'ViewController@getHomePage'
		// ]);
		Route::get('/', [
				'as' => 'welcome',
				'uses' => 'FrontLoadController@getHomePage'
		]);
		Route::get('change/language/{locale}', [
				'uses' => 'LangController@chooser',
				'as' => 'locale'
		]);

		Route::get('{page}', [
				'as' => 'load.page',
				'uses' => 'FrontLoadController@loadPageWithoutArticle'
		]);
		Route::get('{page}/{article}', [
				'as' => 'load.page.with.article',
				'uses' => 'FrontLoadController@loadPageWithArticle'
		]);
});
