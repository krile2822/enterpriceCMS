<?php

namespace CMS\admin\Controllers;

use CMS\admin\Module;
use Config;
use CMS\admin\Page;
use Illuminate\Http\Request;
use CMS\admin\Controllers\PageController;

class ModulesController extends Controller 
{
    public function updateToggle($id) {
        
        $module = Module::where('id', $id)->first();
        $config = $module->config_file;
        if ($module->is_installed == false) {
            $res = $this->doInstall($config);
            
            if ($res) {
                $module->update(['is_installed' => true]);
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'error']);
            }
        // ha installalt    
        } else {
            $pages = Page::where('module_name', $module->name)->get();
            
            if (count($pages) == 0) {
                $res = $this->doUninstall($config);    
            } else {
                return response()->json(['modal' => $module]);
            }

            
            if ($res) {
                $module->update(['is_installed' => false]);
                return response()->json(['message' => 'success']);
            } else {
                return response()->json(['message' => 'error']);
            }
        }
    }
    
    public static function doInstall($config = null) {
        $file = Config::get($config);    
       
        // uj tablak keszitese
        //$file = Config::get('contact_module');
        $create = $file['create_table'];

        if ($create) {
            $new_table = $file['new_table'];
            \DB::statement('CREATE TABLE ' . $new_table . ' (id int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT)');
            // dump('created');
            $new_columns = $file['new_columns'];
            
            foreach ($new_columns as $name => $type) {
                \DB::statement('ALTER TABLE ' . $new_table . ' ADD ' . $name. ' ' .$type);
            }      
        }

        // meglevo tablahoz oszlopok hozzaadasa
        $db = $file['modify_DB'];
        if ($db) {
            
            $table = $file['table'];
            $columns = $file['columns'];
            
            foreach ($columns as $key => $value) {
                \DB::statement('ALTER TABLE ' . $table . ' ADD ' . $value . ' ' . $key);
            }      
        }

        // meglevo tablaba rekord beszurasa
        $new_record = $file['new_record'];
        if ($new_record) {

            $table = $file['record_table'];
            $records = $file['record_columns'];

            foreach ($records as $record) {
                //dump($record);
                \DB::table($table)->insert($record);
            }
        }
        // TEST IT
        $views = $file['views'];
        if ($views) {

            foreach ($views as $view) {
                //dd($view);
                \DB::table('views')->insert($view);
            } 
        }

        return true;

    }

    public function doUninstall($config = null, Request $request = null) {
        if ($config){
            $id = null;
            $file = Config::get($config);
        } else {
            $id = $request['id'];
            $module = Module::where('id', $id)->first();
            $config = $module->config_file;
            $file = Config::get($config);
        }
        
        // uj tablak keszitese
        //$file = Config::get('contact_module');
        $create = $file['create_table'];

        if ($create) {
            $delete_table = $file['new_table'];
            \DB::statement('DROP TABLE ' . $delete_table);
        }

        // meglevo tablahoz oszlopok torlese
        $db = $file['modify_DB'];
        if ($db) {
            
        }

        // meglevo tablabol rekord torlese
        $new_record = $file['new_record'];
        if ($new_record) {

            $table = $file['record_table'];
            $records = $file['record_columns'];

            foreach ($records as $record) {
                //dump($record);
                \DB::table($table)->where('name', $record['name'])->delete();
            }
        }
        // TEST IT
        $views = $file['views'];
        if ($views) {

            foreach ($views as $view) {
                //dd($view);
                \DB::table('views')->where('name', $view['name'])->delete();
            } 
        }
        if ($id != null) {
            $module->update(['is_installed' => false]);
            $pages = Page::where('module_name', $module->name)->get();
            foreach ($pages as $page) {
                if (count($page->articles) > 0) {
                    $page->articles()->delete();
                }
                $page->delete();
            }
            return response()->json(['message' => 'success']);
        } else {
            return true;    
        }
    }
    
    public function getInformation($id) {
        $module = Module::where('id', $id)->first();
        $information = $module->description;
        return view('admin::admin.layouts.module_information', compact('information'));
    }

    public function getSidebarLink(Module $module) {
        dd('asd');
        return view('welcome');
    }
}