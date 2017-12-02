<?php

namespace CMS\admin;

use CMS\admin\View;
use Illuminate\Database\Eloquent\Model;
use CMS\admin\Page;

class Module extends Model
{
    protected $guarded = [];
    protected $table = 'modules';
    
    // override the Eloquent method
    public function getRouteKeyName()
    {
        return 'sidebar';
    }

    public static function getAll() {
        return $modules = Module::all();
    }
    
    public static function getInstalled() {
        return $modules = Module::where('is_installed', true)->get();
    }

    public static function run(Module $module, Page $page) {
    	$page_articles = $page->articles()->orderBy('order_no')->where('published', 1)->get();
        $views = [];

        foreach ($page_articles as $key => $article) {
            $module = View::where('name', $article->view)->first()->belongs_to;
            //plus property for storing module
            $article->module = $module;
        }

    	return view('front::elementy.pages.' . $page->view, compact(['page', 'page_articles']));
    }
}
