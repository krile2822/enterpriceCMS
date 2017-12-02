<?php

namespace CMS\Front\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CMS\admin\Page;
use Session;

class LangController extends Controller {

	public function chooser(Request $request, $locale) {
	    $current = $request->segment(1);
      $curr_url = "url_" . $current;
      //$article = $request->segment(3);
	    $loc = $locale;
      $url = "url_" . $loc;
	    $referer = $request->server('HTTP_REFERER');
      $array = explode('/', $referer); $ref_page = end($array);
      $page = Page::where($curr_url, $ref_page)->first();
      $new_url = $page->$url;
	    $uri = str_replace( $current, $loc, $referer); //change the 1st URL segment to the language code given from GET request
      $uri = str_replace($ref_page, $new_url, $uri);
	    return redirect($uri);
	}

	public static function getLanguageKeys() {
		$languages = config('app.locales');
        $keys = [];
        foreach($languages as $key => $value) {
            $keys[] = $key;
        }
        return $keys;
	}

	public static function getLanguageNames() {
		$languages = config('app.locales');
        $names = [];
        foreach($languages as $key => $value) {
            $names[] = $value;
        }
        return $names;
	}
}
