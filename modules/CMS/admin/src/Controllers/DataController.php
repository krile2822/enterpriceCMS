<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;
use CMS\admin\Page;

class DataController extends Controller
{
    public function getJSONtree() {
        // Get the data for displaying FancyTree. Example below..
        $locale = app()->getLocale();
        $title = 'title_' . $locale;
        $list = [];
        $pages = Page::orderBy('order_no')->get();

        foreach ($pages as $page) {
           $children = [];
           $item['title'] = $page->$title;
           $item['key'] = $page->id;
           $item['folder'] = true;
           $item['selected'] = $page->online;
            $page_articles = $page->articles()->orderBy('order_no')->get();

           foreach( $page_articles as $page_article) {
               $childrens['title'] = $page_article->$title;
               $childrens['key'] = $page_article->pivot->article_id;
               $childrens['selected'] = $page_article->pivot->published;
               $children[] = $childrens;
           }

           $item['children'] = $children;
           $list[] = $item;
        }
        return response()->json($list);
    }
}


/******************** FancyTree JSON Data Example ******************************

[
    {
      "title": "Home",
      "key": 8,
      "folder": true,
      "selected": 1,
      "children": [
                      {
                      "title": "Home Blog",
                      "key": 458,
                      "selected": 0
                      },
                      {
                      "title": "Home Gallery",
                      "key": 459,
                      "selected": 0
                      }
                  ]
    },
    {
      "title": "footer",
      "key": 1,
      "folder": true,
      "selected": 1,
      "children": [
                      {
                      "title": "footer",
                      "key": 444,
                      "selected": 1
                      }
                  ]
    },
    {
      "title": "Gallery",
      "key": 2,
      "folder": true,
      "selected": 1,
      "children": [
                      {
                      "title": "Gallery",
                      "key": 456,
                      "selected": 1
                      },
                      {
                      "title": "Gallery 2",
                      "key": 460,
                      "selected": 1
                      }
                  ]
    }
]
********************************************************************************/
