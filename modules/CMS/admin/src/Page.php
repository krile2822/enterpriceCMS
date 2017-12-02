<?php

namespace CMS\admin;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function articles() {
        return $this->belongsToMany(Article::class)->withPivot('published');
    }

    public static function getPages() {
        $pages = Page::all();
        return $pages;
    }
}
