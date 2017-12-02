<?php

namespace CMS\admin\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use CMS\admin\SlideShowImage;
use CMS\admin\Article;
use CMS\admin\Module;
use CMS\admin\View;
use CMS\admin\Page;
use CMS\admin\User;

/*******************************************************************************
    Controller returns only views (balde files),
    sometimes a value if it is necessary
********************************************************************************/

class ViewController extends Controller
{
    public function valami() {
        return view('admin::valami');
    }

    public function home() {
        return view('admin::welcome');
    }

    public function admin() {
        return view('admin::login');
    }

    public function dashboard() {
        $page_pagination = Page::paginate(4, ['*'], 'pages');
        $article_pagination = Article::paginate(5, ['*'], 'articles');

        return view('admin::admin.home', compact(['page_pagination','article_pagination']));
    }

    public function profile() {
        return view('admin::admin.menu.profile');
    }

    public function users() {
        return view('admin::admin.menu.users');
    }

    public function media() {
        return view('admin::menu.media');
    }

    public function sliders() {
      return view('admin::admin.menu.sliders');
    }
    /*********************************************
        SLIDER ACTIONS
    **********************************************/
    public function newSliderImage() {
       return view('admin::admin.layouts.slider-image-list');
    }

    public function deleteSliderImage() {
      // megvalositani a torlest a bazisbol

      // ujratolteni a kinezetet torles
      return view('admin::admin.layouts.slider-image-list');
    }

    public function getSlideOptions(Request $request) {
      $id = $request['id'];
      $slide = SlideShowImage::findOrFail($id);
      return view('admin::admin.layouts.slider-image-edit', compact(['slide']));
    }

    public function getItemProperties(Request $request) {
      $id = $request['id'];
      return view('admin::admin.layouts.slide-item-properties', compact('id'));
    }

    public function pages() {
        return view('admin::admin.index');
    }

    public function createPage() {
        $modules = Module::getInstalled();
        return view('admin::admin.menu.create-page', compact('modules'));
    }

    public function createArticle(Request $request) {
        $page_id = $request['id'];
        $views = View::all();
        return view('admin::admin.menu.create-article', compact('page_id', 'views'));
    }

    public function refreshJS() {
      return view('admin::admin.includes.script');
    }
    
    public function settings() {
        return view('admin::admin.menu.web-settings');
    }
	
	public function sitemap() {
        return view('admin::admin.menu.sitemap');
    }

    public function modules() {
        $modules = Module::getAll();
        return view('admin::admin.menu.modules', compact('modules'));
    }

    public function getModuleLink(Module $module) {
        return view($module->name . '::' . $module->sidebar );   
    }
}
