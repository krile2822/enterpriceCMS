<?php

namespace CMS\admin;

use Illuminate\Database\Eloquent\Model;

class SlideShowImage extends Model
{
    protected $table = 'slideshow_images';

    // Relationship with the model SLideShowItem
    public function items() {
      return $this->hasMany(SlideShowItem::class);
    }

    public static function getAllImages() {
      $images = SlideShowImage::orderBy('order_no')->get();
      return $images;
    }

    public static function getOnlineImages() {
      $locale = app()->getLocale();
      $filename = 'filename_' . $locale;
      $images = SlideShowImage::where('online', true)->where($filename, '!=' , null)->orderBy('order_no')->get();
      return $images;
    }

}
