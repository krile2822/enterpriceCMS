<?php

namespace CMS\PayPal\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CMS\PayPal\Order;
use Carbon\Carbon;

class OrderController extends Controller
{
    public function changeStatus(Request $request) {
        $order = Order::findOrFail($request['id']);
        $order->status = $request['status'];
        $order->save();
        
        return response()->json(['message' => 'success']);
    }

    public function getResult(Request $request) {
        $order = Order::findOrFail($request['id']);
        $result = $order->result;

        return $result;
    }
}