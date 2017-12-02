<?php

namespace CMS\admin\Controllers;

use Illuminate\Http\Request;
use CMS\admin\SlideShowItem;

class SlideShowItemController extends Controller
{

    // Get the items of the selected slide image
    public function getSlideItems(Request $request) {
        $slideshow_image_id = $request['image'];

        $items = SlideShowItem::where('slide_show_image_id', $slideshow_image_id)->get();

        return view('admin::admin.layouts.slideshow-item-editable', compact(['items', 'slideshow_image_id']));
    }

    // Create new slide image item instance in DB, and add it to the view
    public function createItem(Request $request) {
        $slideshow_image_id = $request['id'];
        $item = new SlideShowItem();
        $item->slide_show_image_id = $slideshow_image_id;
        $item->text_en = 'New slide item';
        $item->class = "very_big_white";
        $item->x = 0;
        $item->y = 0;
        $item->start = 0;
        $item->speed = 0;
        $item->easing = "Bounce.easeIn";
        $item->image_height = 0;
        $item->image_width = 0;
        $item->save();

        $items = SlideShowItem::where('slide_show_image_id', $slideshow_image_id)->get();
        return view('admin::admin.layouts.slideshow-item-editable', compact(['items', 'slideshow_image_id']));
    }

    // Editing the item properties with jQuery Editable
    public function editableSlideItem(Request $request) {
        $item = SlideShowItem::findOrFail($request['pk']);
        if ($request['value'] == '') {
          return response('The field can not be empty!', 400);
        } else {
          if ($request['name'] == 'class') {
            $item->class = $request['value'];
          } elseif ($request['name'] == 'x') {
            $item->x = $request['value'];
          } elseif ($request['name'] == 'y') {
            $item->y = $request['value'];
          } elseif ($request['name'] == 'speed') {
            $item->speed = $request['value'];
          } elseif ($request['name'] == 'start') {
            $item->start = $request['value'];
          } else {
            $item->easing = $request['value'];
          }
          $item->save();
          return response()->json(['message' => 'Item property successfully edited!'], 200);
        }

    }

    public function addImage(Request $request) {
      $item = SlideShowItem::findOrFail($request['item_id']);

      if ($item) {
          $item->type = 2;
          $orig_name = $request->file('item_image')->getClientOriginalName();
          $name = explode('.', $orig_name);
          $filename = $name[0] . '-' . $item->id . '.' . end($name);
          $item->filename = $filename;
          $item->save();

          $dir = '/public/rev_slider/items';
          $request->file('item_image')->storeAs($dir, $filename);
          // $src = '/storage/rev_slider/images/' . $filename;

          return response()->json(['message' => 'Image successfully added'], 200);
      } else {
        return response()->json(['message' => 'Somethin went wrong!']);
      }
    }

    // Publishing/unpublishing the slide image item
    public function publish(Request $request) {
      $slide_item = SlideShowItem::findOrFail($request['id']);
      if ($slide_item) {
        if ($request['status'] == 1) {
            $slide_item->online = 0;
            $status = 0;
        } else {
            $slide_item->online = 1;
            $status = 1;
        }
        $slide_item->save();
        return response()->json(['message' => "Slide image item's status changed successfully!", 'status' => $status]);
      } else {
        return response()->json(['message' => "Something went wrong!"]);
      }

    }

    // Editing the item properties with jQueryForm
    public function editSlideItem(Request $request) {
        $item = SlideShowItem::findOrFail($request['item_id']);

        $item->text_en = $request['text_en'];
        $item->text_sr = $request['text_sr'];
        $item->text_hu = $request['text_hu'];
        $item->href_en = $request['href_en'];
        $item->href_sr = $request['href_sr'];
        $item->href_hu = $request['href_hu'];
        $item->type = $request['type'];
        $item->x = $request['x'];
        $item->y = $request['y'];
        $item->hoffset = $request['hoffset'];
        $item->voffset = $request['voffset'];
        $item->class = $request['class'];
        $item->speed = $request['speed'];
        $item->start = $request['start'];
        $item->depth = $request['depth'];
        $item->easing = $request['easing'];
        $item->endeasing = $request['endeasing'];
        $item->endspeed = $request['endspeed'];
        $item->customout = $request['customout'];
        $item->customin = $request['customin'];
        $item->save();

        $slide_image_id = $item->slide_show_image_id;

        return response()->json(['id' => $slide_image_id ]);
    }

    // Delete the item from DB, and refresh the view
    public function deleteImageItem(Request $request) {
        $item_id = $request['id'];
        $item = SlideShowItem::findOrFail($item_id);
        // AJAXOS MEGVALOS
        // $slideshow_image_id = $item->slideshow_id;
        // if ($item) {
        //   $item->delete();
        // }
        // return response()->json(['message' => 'success', 'slide_id' => $slideshow_image_id]);

        $slideshow_image_id = $item->slide_show_image_id;
        if ($slideshow_image_id) {
            $item->delete();
        }
        $items = SlideShowItem::where('slide_show_image_id', $slideshow_image_id)->get();
        return view('admin::admin.layouts.slideshow-item-editable', compact(['items', 'slideshow_image_id']));
    }
}
