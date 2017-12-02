<?php

namespace CMS\admin;

use Spatie\Sitemap\SitemapGenerator;

class SiteMap
{
    public static function create() {
        $sitemap = SitemapGenerator::create('http://web.dev.icbtech.rs/')->writeToFile(public_path('sitemap.xml'));
        if ($sitemap) {
            return response()->json(['msg' => 'success']);
        } else {
            return response()->json(['msg' => 'failed']);
        }
    }
}
