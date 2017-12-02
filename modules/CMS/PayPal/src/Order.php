<?php

namespace CMS\PayPal;

use Illuminate\Database\Eloquent\Model;
use CMS\admin\Settings;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['name', 'last_name', 'company', 'city', 'zip', 'country', 'email', 'phone', 'quantity', 'unit_price', 'total'];

    public static function getOrdersWithPaginator() {
        $orders = Order::orderBy('created_at', 'desc')->paginate(10);
        return $orders;
    }

    public static function getPayPalCredentials() {
    	$credentials = [];
    	$credentials['client_id'] = Settings::where('name', 'paypal_client_id')->first()->content;
    	$credentials['secret'] = Settings::where('name', 'paypal_secret')->first()->content;

    	return $credentials;
    }
}