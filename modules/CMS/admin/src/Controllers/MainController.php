<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public static function getPage($page) {
//      $p = Page::where('slug', $page )
//            ->where('status', 'ACTIVE')->first();
//      if( $p != null && $p->hasPage == 'yes') {
//            return view($p->slug, compact('p'));
//      } else {
//        return view('welcome2', compact('page'));
//      }
        
        return dd('hello');
    }
}
