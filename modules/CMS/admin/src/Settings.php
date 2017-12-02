<?php

namespace CMS\admin;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = 'settings';
   
    protected $fillable = [
        'name', 'content', 'online', 'type',
    ];
   
    public static function getOnlineSettings() {
        $settings = Settings::where('online', true)->get();
        return $settings;
   }
}
