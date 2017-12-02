<?php

namespace CMS\admin;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $guarded = [];

    // Relationship with model Page
    public function pages() {
        return $this->belongsToMany(Page::class);
    }

    // Relationship with model Media
    public function medias() {
        return $this->hasMany(Media::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public static function getArticles() {
        $articles = Article::all();
        return $articles;
    }

    // TODO nem kell megkerdezni mennyi van, cska torolni az article->name foldert
    public function deleteMedias() {
        $medias = $this->medias;
        if ($medias) {
            foreach ($medias as $media) {
                $media->delete();
            }
        }
        return true;
    }
}
