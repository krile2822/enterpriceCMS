<?php

namespace CMS\admin;

use Illuminate\Database\Eloquent\Model;

class SlideShowItem extends Model
{
    protected $table = 'slide_show_items';

    // Realtionship with model SlideShowImage
    public function image() {
      return $this->belongsTo(SlideShowImage::class);
    }


}
