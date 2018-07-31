<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use App\Gallery;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;

class GalleryController extends Controller {

    public function add_gallery() {
        $albums = \App\Album::get();
        return view('gallery/add_gallery', compact('albums'));
    }

    public function do_add_gallery(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'images' => 'required|array|min:1|max:10',
        ]);

        $finalfolder_name = \App\Album::where('id', $request['album_id'])->value('foldername');
        $files = $request['images'];
        if (!empty($files)):
            foreach ($files as $file):
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $filename = $timestamp . '-' . $file->getClientOriginalName();

                //$image_resize = Image::make($file->getRealPath());
                //$image_resize->resize(300, 300);

                if (!file_exists('uploads/gallery/' . $finalfolder_name)) {
                    mkdir('uploads/gallery/' . $finalfolder_name, 0777, true);
                }
                //$image_resize->save(public_path() . '/uploads/gallery/' . $finalfolder_name . '/', $filename);
                $file->move(public_path() . '/uploads/gallery/' . $finalfolder_name . '/', $filename);
                $gallery = new Gallery();
                $gallery->album_id = $request['album_id'];
                $gallery->images = $filename;
                $gallery->album_description = $request['album_description'];
                $gallery->created_user_id = $created_user_id;
                $gallery->academic_year_id = $academic_year_id;
                $gallery->save();
            endforeach;
        endif;


        $data = array(
            'log_type' => ' Gallery  added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-gallery')->with(['message-success' => 'photos added successfully.']);
    }

    public function getimagesall($album_id) {
        $academic_year_id = Session::get('academic_year_id');
        $images = Gallery::where('album_id', $album_id)->where('academic_year_id', $academic_year_id)->get();
        return view('gallery/view_images', compact('images'));
    }

    public function view_gallery() {
        $academic_year_id = Session::get('academic_year_id');
        $folders = Gallery::groupBy('album_id')->where('academic_year_id', $academic_year_id)->get();
        return view('gallery/view_folders', compact('folders'));
    }

    public function delete_image($album_id, $image_id) {
        $image_name = Gallery::where('id', $image_id)->where('album_id', $album_id)->value('images');
        $folder_name = \App\Album::where('id', $album_id)->value('foldername');
        if ($image_name != '') {
            $image_user = public_path() . '/uploads/gallery/' . $folder_name . '/' . $image_name;
            if (file_exists($image_user)) {
                unlink($image_user);
            }
        }
        Gallery::where('id', $image_id)->where('album_id', $album_id)->delete();
        $images = Gallery::where('album_id', $album_id)->get();
        return ($images);
    }

}
