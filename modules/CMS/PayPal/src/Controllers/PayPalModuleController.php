<?php

namespace CMS\PayPal\Controllers;

use Illuminate\Http\Request;

class PayPalModuleController extends Controller {
	
	public function first(Request $req) {
		return dd($req);
	}
}