<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;
use CMS\admin\Media;
use IntImage;

class MediaController extends Controller
{

    // Return the edit view of the selected media
    public function getMediaForEdit(Request $request) {
      $media = Media::findOrFail($request['id']);
      return view('admin::admin.includes.file-update', compact(['media']));
    }

    //
    public function getnewImage(Request $request) {
        dd($request);
    }

    // If the newly uploaded file is an image, create different
    // dimensions for different usage
    public static function createDimensions($file, $target_dir, $name, $extension) {
        $dimensions = app()->config->get('theme.dimensions');

        foreach($dimensions as $dim) {
          if ($dim['operation'] == 'resize') {
              $image = IntImage::make($file)
                  ->resize($dim['width'], $dim['height'])
                  ->save(storage_path() . '/app/' . $target_dir . '/' . $name . $dim['name'] . '.' . $extension);
          } elseif ($dim['operation'] == 'fill') {
              $image = IntImage::make($file)
                  ->resizeCanvas($dim['width'], $dim['height'], 'center', false, '#fff')->save(storage_path() . '/app/' . $target_dir . '/' . $name . $dim['name'] . '.' . $extension);
          } else {
              $image = IntImage::make($file)
                  ->crop($dim['width'], $dim['height'])
                  ->save(storage_path() . '/app/' . $target_dir . '/' . $name . $dim['name'] . '.' . $extension);
          }
        }
    }
}
