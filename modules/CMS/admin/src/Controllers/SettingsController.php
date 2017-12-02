<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;
use CMS\admin\Settings;
use Yajra\DataTables\DataTables;

class SettingsController extends Controller
{
    public function submitForm(Request $request) {
        dd($request);
    }
    
    public function getData() {
        $settings = Settings::all();
        
        
        return Datatables::of($settings)
                ->rawColumns(['action', 'delete'])
            ->addColumn('action', function ($setting) {
                return '<a data-id="'.$setting->id.'" data-toggle="modal" data-target="#edit_modal" class="btn btn-xs btn-primary">'
                        . '<i class="glyphicon glyphicon-edit"></i> Edit</a>';
            })
            ->addColumn('delete', function ($setting) {
                return '<a data-id="'.$setting->id.'" data-toggle="modal" data-target="#delete_modal" class="btn btn-xs btn-danger">'
                        . '<i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
           
    }
    
    public function store(Request $request) {
        if ($request['is_online'] == 'online') {
            $online = true;
        } else {
            $online = false;
        }
        
        Settings::create([
            'name' => $request['name'],
            'content' => $request['content'],
            'online' => $online,
            'type' => $request['type']
        ]);
        
        return response()->json(['status' => 'success']);
    }
    
    public function update(Request $request) {
        $setting = Settings::findOrFail($request['id']);
        
        $setting->name = $request['name'];
        $setting->content = $request['content'];
        $setting->type = $request['type'];
        if ($request['is_online'] != null) {
            $setting->online = true;
        } else {
            $setting->online = false;
        }
        
        $setting->save();
        
        return response()->json(['status' => 'success']);
    }
    
    public function delete(Request $request) {
        Settings::where('id', $request['id'])->delete();
        
        return response()->json(['status' => 'success']);
    }
    
    public function getSelectedSetting(Request $request) {
        $setting = Settings::findOrFail($request['id']);
        
        return response()->json(['name' => $setting->name, 'content' => $setting->content,'type' => $setting->type, 'online' => $setting->online]);
    }
}