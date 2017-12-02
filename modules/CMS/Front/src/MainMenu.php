<?php

namespace CMS\Front;

use Carbon\Carbon;
use CMS\admin\Page;
use CMS\admin\Article;

class MainMenu
{
	// This function creates the main menu, the main links on the frontend site
	public static function getMainMenu() {
		$locales = app()->config->get('app.locales');
		$locale = app()->config->get('app.locale');
		// all the page where is the 'appears in navigation' propery is true
		// and the page is online (checked in the FancyTree)
		$main_menu = Page::where('appears', true)
			->where('online', true)
			->orderBy('order_no')
			->get();

		$menu = [];

		if (count($locales) > 1) {
			$title = 'title_' . app()->getLocale();
			$url = 'url_' .app()->getLocale();
		} else {
			$title = 'title_' . $locale;
			$url = 'url_' . $locale;
		}

		$today = Carbon::today();

		foreach ($main_menu as $page) {
			$children = [];
			$child_publish = false; // valtozo amiben letaroljuk hogy van e legalabb 1 gyermeke publikalt
			$menu_item['name'] = $page->$title;
			$menu_item['url'] = $page->$url;
			if ($articles = $page->articles->where('start_date', '<=', $today)->where('end_date', '>=' , $today)) {
				foreach ($articles as $article) {
					if ($child_publish == false) {
						if ($article->pivot->published == true) {
							$child_publish = true;
						}
					}
					if ($article->pivot->published == true && $page->articles_nav == true) {
						$c['url'] = $article->$url;
						$c['title'] = $article->$title;
						$children[] = $c;
						//$children[] = $article->$title;
					}
				}
				$menu_item['children'] = $children;
				$menu_item['child_publish'] = $child_publish;
			}
			$menu[] = $menu_item;
		}

		return $menu;

	}
}
