<?php

namespace CMS\Front\Controllers;

use Illuminate\Routing\Controller;
use CMS\admin\Page;
use CMS\admin\Article;

class MainMenuController extends Controller
{

	// !!!!!!!!THIS FUNCTION IS NOT USED!!!!!!!!!
	// This function creates the main menu, the main links on the frontend site
	public static function getMainMenu() {


		// all the page where is the 'appears in navigation' propery is true
		// and the page is online (checked in the FancyTree)
		$main_menu = Page::where('appears', true)
			->where('online', true)
			->get();

		$menu = [];
		$title = 'title_' . app()->getLocale();

		foreach ($main_menu as $key => $item) {
			$children = [];
			$menu_item['name'] = $item->$title;
			if ($item->articles) {
				foreach ($item->articles as $article) {
					$children[] = $article->name;
				}
				$menu_item['children'] = $children;
			}

			$menu[] = $menu_item;
		}

		return view('front::jollyany.elements.context_menu_view', compact(['menu']));
	}
}
