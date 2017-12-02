<?php

namespace CMS\admin\Controllers;

use CMS\admin\SiteMap;
use Illuminate\Routing\Controller;

class SiteMapController extends Controller
{
    public static function generateSiteMap() {
        SiteMap::create();
    }
}

