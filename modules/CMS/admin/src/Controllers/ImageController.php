<?php

namespace CMS\admin\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use CMS\admin\Article;
use CMS\admin\Image;
use CMS\admin\Media;
use IntImage;

class ImageController extends Controller {

    public function mediaUpload(Request $request) {
      // Upload media for articles
      $lang = app()->getLocale();  
        
      $this->validate($request, [
          'name' => 'required',
          'folder' => 'required'
      ]);
      $image = ['gif', 'png', 'jpg', 'jpeg', 'bmp'];
      $id = $request['article_id'];
      $storage = $request['folder'] . "-" .$id;

      $file = explode('.', $request['name']);
      $name = $file[0];
      $extension = $file[1];
      $filename = $name . '.' . $extension;
      $target_dir = 'public/'. $storage;
      if ($target_dir) {
          // is the directory exists or not
          if ( !file_exists($target_dir) ) {
              Storage::makeDirectory($target_dir);
          }
          // Store the file
          $request->file('file')->storeAs($target_dir, $filename);
          //Storage::disk('local')->put($target_dir, $request->file('file'));
          
          $title = 'title_' . $lang;
          
          // Create DB instance
          Media::create([
              'article_id' => $id,
              'storage' => $storage,
              'file_name' => $name,
              'extension' => $extension,
              $title => $name
          ]);

          $file = $request->file('file');
          // If the media is an image, create different sizes of picture
          // createDimensions function uses InterventionImage plugin
          if (in_array($extension, $image)) {
              MediaController::createDimensions($file, $target_dir, $name, $extension);
          }

          return array("success" => true, "message" => "File(s) uploaded successfully!");
      } else {
          return array("success" => false, "error" => "There is some error");
      }
    }

    // Old version of mediaUpload function
    public function imageUpload(Request $request) {
        $this->validate($request, [
            'name' => 'required',
            'folder' => 'required'
        ]);

        $id = $request['article_id'];
        $storage = $request['folder'] . "-" .$id;

        $filename = $request['name'];
        $name = explode('.', $filename);
        $target_dir = 'public/'. $storage;

        if ($target_dir) {

            if ( !file_exists($target_dir) ) {
                Storage::makeDirectory($target_dir);
            }

            $request->file('file')->storeAs($target_dir, $filename);
            //Storage::disk('local')->put($target_dir, $request->file('file'));

            Image::create([
                'name' => $filename,
                'article_id' => $id,
                'storage' => $storage
            ]);

            $thumb = IntImage::make($request->file('file'))
                ->resize(100, 100)
                ->save(storage_path() . '/app/' . $target_dir . '/' . $name[0] . '_thumb.' . $name[1]);

            return array("success" => true, "message" => "File(s) uploaded successfully!");
        } else {
            return array("success" => false, "error" => "There is some error");
        }
    }

    public function getArticleMedia(Request $request) {
      // Get all media where is the id = id of selected article
      $id = $request['article_id'];
      $storage = $request['storage'] . "-" . $id;

      $article = Article::where('id', $id)->first();
      $all_media = $article->medias()
                        ->orderBy('order_no')
                        ->get();

      return view('admin::admin.FineUpload.upload-form', compact(['all_media', 'article']));
    }

    // Old verison of getArticleMedia function
    public function getArticleImages(Request $request) {
        $id = $request['article_id'];
        $storage = $request['storage'] . "-" . $id;

        $all_image = Image::where('article_id', $id)
                ->where('storage', $storage)
                ->orderBy('order_no')
                ->get();
        $article = Article::where('id', $id)->first();

        return view('admin::admin.FineUpload.upload-form', compact(['all_image', 'article']));
    }

    public function deleteArticleMedia(Request $request) {
        // Delete media below an article
        $id = $request['image_id'];
        $img = $request['img'];

        $path = explode("/", $img);

        $filename = explode('.', $path[3]);
        $dir =  storage_path('app/public/' . $path[2]);
        $storage = '/public/' . $path[2] . '/'; //   /public/Article6-449

        // create the image (path.name.extension)
        $img = $storage . $filename[0] . '.' . $filename[1];
        // Verify is it exists
        $exists = Storage::disk('local')->exists($img);
        $dimensions = app()->config->get('theme.dimensions');

        if ($exists) {
            // Delete the real size image
            Storage::delete($img);

            // Delete all dimensions of the image
            foreach($dimensions as $dim) {
                $img = $storage . $filename[0] . $dim['name'] . '.' . $filename[1]; /* /public/Article6-449/filename_size.extension */
                Storage::delete($img);
            }

            // Delete media from the DB
            Media::where('id', $id)->delete();

            // If there is no other media in this folder delete it
            if ($this->is_dir_empty($dir)) {
                rmdir($dir);
            }

            return response()->json([
                "delete" => "success"
            ]);
        } else {
            return response()->json(["delete" => "failed"]);
        }
    }

    // Old version of deleteArticleMedia function
    public function deleteArticleImage(Request $request) {
        $id = $request['image_id'];
        $img = $request['img'];

        $path = explode("/", $img);
        $filename = explode('.', $path[3]);

        $dir =  storage_path('app/public/' . $path[2]);

        $img = str_replace("/storage", "/public", $img);
        $thumb_img =  '/public/' . $path[2] . '/' . $filename[0] . '_thumb.' . $filename[1];

        $exists = Storage::disk('local')->exists($img);

        if ($exists) {
            // delete real size image from storage and from base
            Storage::delete($img, $thumb_img);
            Image::where('id', $id)->delete();

            if ($this->is_dir_empty($dir)) {
                rmdir($dir);
            }

            return response()->json([
                "delete" => "success"
            ]);
        } else {
            return response()->json(["delete" => "failed"]);
        }
    }

    // Old version of sortMedia function
    public function sortImages(Request $request) {
        $array = $request['ids'];
        $size = sizeof($array) - 1;

        for ($i = 0; $i <= $size; $i++) {
            $id = $array[$i];

            $image = Image::findOrFail($id);

            if ($image) {
                $position = $i + 1;
                $image->order_no = $position;
                $image->save();
            }
        }
        return response()->json(['sort' => 'success']);
    }

    // Medias are draggable, this is the sort function when the
    // succession is changing
    public function sortMedia(Request $request) {
      $array = $request['ids'];
      foreach ($array as $key => $id) {
        // In the loop, the slide image finds by $value (id),
        // and its rank will be the $key + 1
          $media = Media::findOrFail($id);
          if ($media) {
              $media->order_no = $key + 1;
              $media->save();
          }
      }

      return response()->json(['sort' => 'success']);
    }

    // Is The Directory Empty function
    public function is_dir_empty($dir) {
        if (!is_readable($dir)) {
            return NULL;
        }
        $handle = opendir($dir);

        while (false !== ($entry = readdir($handle))) {
          if ($entry != "." && $entry != "..") {
            return FALSE;
          }
        }
        return TRUE;
    }
}
