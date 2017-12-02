<?php

namespace CMS\admin\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Session;

class LangController extends Controller {

	// Language chooser function
	// get the current url, and change the locale tag
	public function chooser(Request $request, $locale) {
	    $segment = $request->segment(1);
	    $loc = $locale;
	    $referer = $request->server('HTTP_REFERER');
	    $uri = str_replace( $segment, $loc, $referer);
	    return redirect($uri);
	}

	/**************USED ONLY FOR MIGRATION FILES. ISN'T WORKING******************

	// Get all the language keys from config file
	public static function getLanguageKeys() {
		$languages = config('app.locales');
        $keys = [];
        foreach($languages as $key => $value) {
            $keys[] = $key;
        }
        return $keys;
	}

	// Get all the language names from config file
	public static function getLanguageNames() {
		$languages = config('app.locales');
        $names = [];
        foreach($languages as $key => $value) {
            $names[] = $value;
        }
        return $names;
	}

	*****************************************************************************/
}
