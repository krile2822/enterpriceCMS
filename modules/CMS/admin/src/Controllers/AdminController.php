<?php 

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
	public function get() {
		return view("admin::index");
	}
}