<?php

namespace CMS\Front\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CMS\admin\Page;

class ViewController extends Controller
{

		// home page's url is http://.../en/home. If search for  http://.../ redirect to /en/home
		public function getHomePage(Request $request) {
				$home = Page::where('home_page', 1)->first();
				$locales = app()->config->get('app.locales');
				if (count($locales) > 1) {
					$locale = app()->getLocale();
					$url = "url_" . $locale;
					$home_url = '/' . $home->$url;
					$current_url = $request->segments();
					$new_url = $current_url[0] . $home_url;
					return redirect($new_url);
				} else {
					$locale = app()->getLocale();
					$url = "url_" . $locale;
					$home_url = '/' . $home->$url;
					// $current_url = $request->segments();
					// $new_url = $current_url[0] . $home_url;
					return redirect($home_url);
				}

		}

}
