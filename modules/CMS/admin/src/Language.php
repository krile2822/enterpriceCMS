<?php

namespace CMS\admin;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    public function settings() {
        $this->belongsTo(Settings::class);
    }

    public static function getAllLanguageCode() {
        $languages = Language::all();
        $codes = [];
        foreach ($languages as $language) {
            $codes[] = $language->code;
        }
        return $codes;
    }

    public function getLocale() {
        $locale = app()->getLocale();
        return $locale;
    }

    public static function getLanguages() {
      $langs = app()->config->get('app.locales');
      return $langs;
    }

     public static function getDefaultLang() {
        $defLang = Language::where('default', 1)->first();
        return $defLang;
     }
}
