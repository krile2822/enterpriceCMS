<?php

namespace CMS\admin\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CMS\admin\Module;
use CMS\admin\Article;
use CMS\admin\Image;
use CMS\admin\Page;
use CMS\admin\View;
use Config;

class PageController extends Controller {

    // Returns the view with all the attributes when the user select a page or
    // an article in the FancyTree
    public function getPageFromTree(Request $request) {
        $parent_id = $request['parent'];

        if ($request['type'] == 'page') {
            $page = Page::find($request['id']);

            return view('admin::admin.page-form', compact('page'));
        } elseif ($request['type'] == 'article') {
            $article = Article::find($request['id']);
            $page = Page::where('id', $parent_id)->first();
            if ($page->module_name) {
                $views = View::where('belongs_to', $page->module_name)->orWhere('belongs_to', 'theme')->get();
            } else {
                $views = View::where('belongs_to', 'theme')->get();
            }
            $all_media = $article->medias()
                              ->orderBy('order_no')
                              ->get();

            return view('admin::admin.article-form', compact(['article', 'parent_id', 'all_media', 'views', 'page']));
        } else {
            return null;
        }
    }

    // Funciton for storing a new page entity
    public function store(Request $request) {
        $user_id = auth()->user()->id;
        $date = date("Y-m-d");

        if ($request['appears'] == 'on') {
            $appears = 1;
        } else {
            $appears = 0;
        }

        if ($request['bc'] == 'on') {
            $bc = 1;
        } else {
            $bc = 0;
        }

        if ($request['featured'] == 'on') {
            $featured = 1;
        } else {
            $featured = 0;
        }

        if ($request['articles_nav'] == 'on') {
            $articles_nav = 1;
        } else {
            $articles_nav = 0;
        }

        Page::create([
            //'parent_id' => $request['parent_id'],
            'module_name' => $request['module_name'],
            'view' => $request['view'],
            'article_ordering' => $request['article_ordering'],
            'per_page' => $request['per_page'],
            'appears' => $appears,
            'articles_nav' => $articles_nav,
            'bc' => $bc,
            'featured' => $featured,
            'description_en' => $request['description_en'],
            'description_sr' => $request['description_sr'],
            'description_hu' => $request['description_hu'],
            'title_en' => $request['title_en'],
            'title_sr' => $request['title_sr'],
            'title_hu' => $request['title_hu'],
            'author_id' => $user_id,
            'url_en' => $request['url_en'],
            'url_sr' => $request['url_sr'],
            'url_hu' => $request['url_hu'],
            'page_langs' => $request['page_langs'],
            'date_posted' => $date
        ]);

        return redirect()->back()->with('status', 'Page saved!');
    }

    // Function for updating a page
    public function update(Request $request, $id) {     
        $page = Page::findOrFail($id);

        //$page->parent_id = $request['parent_id'];
        $page->module_name = $request['module_name'];
        $page->view = $request['view'];
        $page->article_ordering = $request['article_ordering'];
        $page->per_page = $request['per_page'];
        $page->page_langs = $request['page_langs'];
        $page->title_en = $request['title_en'];
        $page->title_sr = $request['title_sr'];
        $page->title_hu = $request['title_hu'];
        $page->url_en = $request['url_en'];
        $page->url_sr = $request['url_sr'];
        $page->url_hu = $request['url_hu'];
        $page->description_en = $request['description_en'];
        $page->description_sr = $request['description_sr'];
        $page->description_hu = $request['description_hu'];

        if ($request['appears'] == 'on') {
            $page->appears = 1;
        } else {
            $page->appears = 0;
        }

        if ($request['articles_nav'] == 'on') {
            $page->articles_nav = 1;
        } else {
            $page->articles_nav = 0;
        }

        if ($request['bc'] == 'on') {
            $page->bc = 1;
        } else {
            $page->bc = 0;
        }

        if ($request['featured'] == 'on') {
            $page->featured = 1;
        } else {
            $page->featured = 0;
        }
        
        // check installed modules, and its form elements
        $installed = Module::getInstalled();
        if (count($installed) != 0) {
            foreach ($installed as $ins) {
               if (Config::get($ins->config_file . '.modify_DB')) {
                   $columns = Config::get($ins->config_file . '.columns');
                   foreach ($columns as $value) {
                       // csak checkboxokra ervenyes
                       if ($request[$value] == 'on') {
                            $page->$value = true;
                       } else {
                            $page->$value = false;
                       }
                   }
               } 
            }
        }

        $page->save();
        return redirect()->back()->with('status', 'Page updated!');
    }

    // Function for deleting selected page
    public function destroy(Request $request) {
        $id = $request['id'];

        $page = Page::findOrFail($id);

        // If the page really exists
        if ($page) {
            // get its childs (articles)
            $articles = $page->articles;

            // if there is a child/children
            if ($articles) {
                // delete the relationship with children in article_page table and delete its medias
                foreach ($articles as $a) {
                    $article = DB::table('article_page')
                                    ->where('article_id', $a->id)
                                    ->where('page_id', $id)->delete();

                    $a->deleteMedias();
                    $a->delete();
                }

                // If the child articles used by another page do nothing
                // else delete the article and it's all medias
                // foreach ($articles as $a) {
                //     $article = DB::table('article_page')
                //                     ->where('article_id', $a->id)->first();

                //     if (!$article) {
                //         $image = Image::where('article_id', $a->id)->first();
                //         $dir = "/home/krisztian/Documents/LRVL/CMS/storage/app/public/" . $image->storage;
                //         Image::where('article_id', $a->id)->delete();
                //         ArticleController::rmdir_recursive($dir);
                //         // Delete the article
                //         Article::where('id', $a->id)->delete();
                //     }
                // }
            }
        }
        // Finally delete the page
        Page::where('id', $id)->delete();

        return response()->json(['delete' => 'success']);
    }

    // Order the pages in the FancyTree
    public function pageOrder(Request $request) {
        $array = $request['array'];

        foreach ($array as $key => $id) {
          $page = Page::findOrFail($id);

          if ($page) {
            $page->order_no = $key + 1;
            $page->save();
          }
        }
        return response()->json(['order' => 'success']);
    }

    // If the page is checked in the FancyTree that means that it is online
    public function onlineToggle(Request $request) {
        $id = $request['id'];

        $page = Page::findOrFail($id);

        if($page) {
            if($page->online == 0) {
                $page->online = 1;
                $page->save();
                return response()->json(['messgage' => 'OKS']);
            } else {
                $page->online = 0;
                $page->save();
                return response()->json(['messgage' => 'OK']);
            }
        }else  {
            return response()->json(['message' => 'No page with this id']);
        }
    }

}
