<?php

Route::group(['namespace' => 'CMS\PayPal\Controllers', 'middleware' => ['web']], function() {

	/* PayPal*/
        Route::post('payment', [
         'as' => 'payment',
         'uses' => 'PayPalController@postPayment',
         ]);
         // this is after make the payment, PayPal redirect back to your site
         Route::get('after/paypal/payment/status', [
             'as' => 'payment.status',
             'uses' => 'PayPalController@getPaymentStatus',
         ]);

 	/* Orders */

 	Route::post('order/change-status', [
		'as' => 'status.change',
		'uses' => 'OrderController@changeStatus'
	]);
	Route::post('order-result', [
		'as' => 'get.order.result',
		'uses' => 'OrderController@getResult'
	]);
});