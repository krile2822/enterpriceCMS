<?php

namespace CMS\admin;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = [
        'name', 'article_id', 'storage'
    ];

    public function article() {
        return $this->belongsTo(Article::class);
    }
}
