<?php

namespace CMS\Front\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CMS\admin\Article;
use CMS\admin\Page;
use CMS\admin\Module;
use Carbon\Carbon;
use MatthiasMullie\Minify;

class FrontLoadController extends Controller
{

    public function getHomePage(Request $request) {
      $locale = app()->config->get('app.locale');
      $url = 'url_' . $locale;
      $page = Page::where($url, 'home')->first();
      if ($page) {
          $pagination = $page->per_page;
          $page_id = $page->id;
          $view = $page->view;
      } else {
        $page_id = null;
      }

      if ($page_id != null ) {
          if (DB::table('article_page')->where('page_id', $page_id)->where('published', 1)->first() != null ) {
            $today = Carbon::today();
            $page_articles = $page->articles()->where('published', 1)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->paginate($pagination);
            return view('front::elementy.pages.' .$view, compact(['page', 'page_articles']));
          } else {
            // Ez az eset akkor kovetkezik be amikor nincs, vagy nincs publikalt article az oldal alatt
            // Ekkor a blade file-ban az a resz teljesul amikor a $page_articles == NULL
            $page_articles = null;
            return view('front::elementy.pages.' .$view, compact(['page', 'page_articles']));
          }
      } else {
        return "No pages";
      }
    }

    // /page -> nincs nyelvi valtozo az URL-ben
    public function loadPageWithoutArticle(Request $request) {      
      $segment = $request->segment(1); // not array first elements index 1
      $locale = app()->config->get('app.locale');
      $url = 'url_' . $locale;
      $page = Page::where($url, $segment)->first();

      if ($page->module_name) {
        $module = Module::where('name', $page->module_name)->first();
        return Module::run($module, $page);        
      } else {
              if ($page) {
                  $pagination = $page->per_page;
                  $page_id = $page->id;
                  $view = $page->view;
              } else {
                $page_id = null;
              }

              // ha van article akkor olyan view-t adunk at amibe article-t kell tolteni es akkor mar itt at tudjuk adni az articleket is
              if ($page_id != null ) {
                  if (DB::table('article_page')->where('page_id', $page_id)->where('published', 1)->first() != null ) {
                    $today = Carbon::today();
                    $page_articles = $page->articles()->where('published', 1)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->paginate($pagination);
                    // $main_menu = MainMenu::getMainMenu();
                    return view('front::elementy.pages.' .$view, compact(['page', 'page_articles']));
                  } else {
                    // Ez az eset akkor kovetkezik be amikor nincs, vagy nincs publikalt article az oldal alatt
                    // Ekkor a blade file-ban az a resz teljesul amikor a $page_articles == NULL
                    $page_articles = null;
                    // $main_menu = MainMenu::getMainMenu();
                    return view('front::elementy.pages.' .$view, compact(['page', 'page_articles']));
                  }
              } else {
                return "No pages";
        }
      }
      // - atadjuk a view fajtajat is es a page oldalon olyan article view loadolunk bele ami kell
      // ha pedig nincs akkor egy egyszeru oldal nezetet toltunk be neki

    }

    // /en/page
    public function loadPageWithoutArticleMulti(Request $request) {
      $segments = $request->segments();
      $locale = $segments[0];
      $url = 'url_' . $locale;
      $title = $segments[1]; // title most a bazisban url_locale-nak szamit, csak az url valtozonev mar foglalt
      $page = Page::where($url, $title)->first();

      if ($page) {
          $pagination = $page->per_page;
          $page_id = $page->id;
          $view = $page->view;
      } else {
        $page_id = null;
      }


      // - ha van article akkor olyan view-t adunk at amibe article-t kell tolteni es akkor mar itt at tudjuk adni az articleket is
      if ($page_id != null ) {
          if (DB::table('article_page')->where('page_id', $page_id)->where('published', 1)->first() != null ) {
            $today = Carbon::today();
            $page_articles = $page->articles()->where('published', 1)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->paginate($pagination);
            // $main_menu = MainMenu::getMainMenu();
            return view('front::elementy.pages.' .$view, compact(['page', 'page_articles']));
          } else {
            // Ez az eset akkor kovetkezik be amikor nincs, vagy nincs publikalt article az oldal alatt
            // Ekkor a blade file-ban az a resz teljesul amikor a $page_articles == NULL
            $page_articles = null;
            // $main_menu = MainMenu::getMainMenu();
            return view('front::elementy.pages.' .$view, compact(['page', 'page_articles']));
          }
      } else {
        return "No pages";
      }
    }

    /***********************
          page/article
    ***********************/
    public function loadPageWithArticle(Request $request) {
      $segments = $request->segments(); // not array first elements index 1
      $locale = app()->config->get('app.locale');
      $url = 'url_' . $locale;
      $page = Page::where($url, $segments[0])->first();


      if ($page != null) {
         if ($segments[1] != null) {
           $article = Article::where($url, $segments[1])->first();
           if (! $article) {
             return dd('URL: locale/first/second. Second segment is not an article in the DB');
           }
         }

       $exist = DB::table('article_page')
               ->where('page_id', $page->id)
               ->where('article_id', $article->id)
               ->where('published', true)
               ->get();

       if ($exist) {
           if (1 == 1) {
               $today = Carbon::today();
               // paginate szukseges mivel ugyanazt a view-t hasznalja mint a blade amely listat jelenit meg es ott hasznaljuk a ->total() fuggvenyt
               // ha nem hasznaljuk itt paginate() fuggvenyt annak ellenere h biztosan csak 1 talalat van, nem tudjuk a kesobbiekben hasznalni a ->total()
               // fuggvenyt sem
               $page_articles = $page->articles()->where('id', $article->id)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->paginate();
                // $main_menu = MainMenu::getMainMenu();
               if ($page_articles->total() != 0) {
                   return view('front::elementy.pages.default', compact(['page', 'article', 'page_articles']));
               } else {
                 return dd('No article');
               }
           }
       }
     } else {
       return "No page";
     }
    }

    public function loadPageWithArticleMulti(Request $request) {
      $segments = $request->segments();
      $locale = $segments[0];
      $url = 'url_' . $locale;
      $title = $segments[1]; // title most a bazisban url_locale-nak szamit, csak az url valtozonev mar foglalt
      $page = Page::where($url, $title)->first();

      if ($page != null) {
         if ($segments[2] != null) {
           $article = Article::where($url, $segments[2])->first();
           if (! $article) {
             return dd('URL: locale/first/second. Second segment is not an article in the DB');
           }
         }

       $exist = DB::table('article_page')
               ->where('page_id', $page->id)
               ->where('article_id', $article->id)
               ->where('published', true)
               ->get();

       if ($exist) {
           if ($page->view == 'default') {
               $today = Carbon::today();
               // paginate szukseges mivel ugyanazt a view-t hasznalja mint a blade amely listat jelenit meg es ott hasznaljuk a ->total() fuggvenyt
               // ha nem hasznaljuk itt paginate() fuggvenyt annak ellenere h biztosan csak 1 talalat van, nem tudjuk a kesobbiekben hasznalni a ->total()
               // fuggvenyt sem
               $page_articles = $page->articles()->where('id', $article->id)->where('start_date', '<=', $today)->where('end_date', '>=', $today)->paginate();
                 // $main_menu = MainMenu::getMainMenu();
               if ($page_articles->total() != 0) {
                   return view('front::elementy.pages.default', compact(['page', 'article', 'page_articles']));
               } else {
                 return dd('No article');
               }
           }
       }
     } else {
       return "No page";
     }

    }

    public static function getContextMenu($id) {
      $today = Carbon::today();
      $page = Page::findOrFail($id);
      $articles = $page->articles->where('start_date', '<=', $today)->where('end_date', '>=', $today);
      return $articles;
    }
    
    public static function minifyCSS() {
        
        if (! file_exists(public_path('css/minified.css'))) {
            $fileContents = file_get_contents(public_path('css/custom.css'));
            $minifier = new Minify\CSS($fileContents);

            // we can even add another file, they'll then be
            // joined in 1 output file
            $file2 = file_get_contents(public_path('css/customCMS.css'));
            $minifier->add($file2);
            $file3 = file_get_contents(public_path('css/jollyany-style.css'));
            $minifier->add($file3);
            $file4 = file_get_contents(public_path('css/blue.css'));
            $minifier->add($file4);

            $file5 = file_get_contents(public_path('admin/bootstrap/dist/css/bootstrap.min.css'));
            $minifier->add($file5);

            // save minified file to disk
            //$minifiedPath = '/public/css/minified.css';
            $minified = $minifier->minify();

            $outputFilePath = public_path('css/minified.css');
            file_put_contents($outputFilePath, $minified);
            // or just output the content
        } return ;
    }
    
    public static function minifyJS() {
        
        if (! file_exists(public_path('js/minified.js'))) {
            $file = file_get_contents(public_path('js/jquery.isotope.min.js'));
            $minifier = new Minify\JS($file);

            // we can even add another file, they'll then be
            // joined in 1 output file
            $file2 = file_get_contents(public_path('js/custom-portfolio.js'));
            $minifier->add($file2);

            $file3 = file_get_contents(public_path('jollyany/js/owl.carousel.min.js'));
            $minifier->add($file3);

            $file4 = file_get_contents(public_path('jollyany/rs-plugin/js/jquery.themepunch.plugins.min.js'));
            $minifier->add($file4);

            $file5 = file_get_contents(public_path('jollyany/rs-plugin/js/jquery.themepunch.revolution.min.js'));
            $minifier->add($file5);

            $file6 = file_get_contents(public_path('jollyany/js/custom.js'));
            $minifier->add($file6);

            $minified = $minifier->minify();

            $outputFilePath = public_path('js/minified.js');
            file_put_contents($outputFilePath, $minified);
        } return ;
    }
}
