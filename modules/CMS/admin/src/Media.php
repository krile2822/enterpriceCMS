<?php

namespace CMS\admin;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  protected $table = 'media';
  protected $fillable = [
      'article_id', 'storage', 'title_en', 'title_hu', 'title_sr', 'order_no', 'file_name', 'extension', 'appears_hu', 'appears_en', 'appears_sr',
    ];

    public function article() {
        return $this->belongsTo(Article::class);
    }

    // is the uploaded media image
    public static function isImage($ext) {
      $image = ['jpg', 'jpeg', 'gif', 'png', 'bmp'];
      if (in_array($ext, $image)) {
        return TRUE;
      } else {
        return FALSE;
      }
    }
}
