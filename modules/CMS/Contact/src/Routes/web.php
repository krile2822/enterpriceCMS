<?php

Route::group(['namespace' => 'CMS\Contact\Controllers', 'middleware' => ['web']], function() {

	Route::post('email/send', [
		'as' => 'email.send',
		'uses' => 'ContactController@leaveMessage'
	]);

	Route::post('get-selected-mail', [
		'as' => 'get.selected.mail',
		'uses' => 'ViewController@getSelectedMail'
	]);
});