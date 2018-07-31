<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use App\Event_album;
use App\Http\Controllers\Controller;

class EventsAlbumController extends Controller {

    public function view_event_albums() {
        $academic_year_id = Session::get('academic_year_id');
        $folders = Event_album::where('academic_year_id', $academic_year_id)->groupBy('event_title_id')->get();
        return view('event_albums/view_event_albums', compact('folders'));
    }

    public function getimagesall($event_title_id) {
        $academic_year_id = Session::get('academic_year_id');
        $images = Event_album::where('event_title_id', $event_title_id)->where('academic_year_id', $academic_year_id)->get();
        return view('event_albums/view_event_images', compact('images'));
    }

    public function add_event_album($event_title_id) {
        $events = \App\Event::where('status', '1')->get();
        $event_albums = \App\Event_title::where('status', '1')->where('id', $event_title_id)->get();
        return view('event_albums/add_event_album', compact('events', 'event_albums'));
    }

    public function do_add_event_album(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'images' => 'required',
            'images.*' => 'mimes:jpeg,png,jpg,gif,svg',
            'event_title_id' => 'required',
        ]);

        $finalfolder_name = \App\Event_title::where('id', $request['event_title_id'])->value('foldername');
        //print_r($finalfolder_name);exit;

        $files = $request['images'];
        if ($files[0] !=""):
            foreach ($files as $file):
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $img = $file->getClientOriginalName();
                $result = array_map('strrev', explode('.', strrev($img)));
                $filename = $timestamp . '.' . $result[0];
                if (!file_exists('uploads/events/' . $finalfolder_name)) {
                    mkdir('uploads/events/' . $finalfolder_name, 0777, true);
                }
                $file->move(public_path() . '/uploads/events/' . $finalfolder_name . '/', $filename);
                $gallery = new Event_album();
                $gallery->event_title_id = $request['event_title_id'];
                $gallery->images = $filename;
                $gallery->image_description = $request['image_description'];
                $gallery->created_user_id = $created_user_id;
                $gallery->academic_year_id = $academic_year_id;
                $gallery->save();
            endforeach;
        else:
             return redirect('add-event-album/'.$request['event_title_id'])->with(['message1-danger' => 'Please select atleast one image.']);
        endif;

        $data = array(
            'log_type' => ' Event Album added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-event-albums')->with(['message-success' => 'Event Album added successfully.']);
    }

    public function delete_image($event_title_id, $image_id) {
        $image_name = Event_album::where('id', $image_id)->where('event_title_id', $event_title_id)->value('images');
        $folder_name = \App\Event_title::where('id', $event_title_id)->value('foldername');
        if ($image_name != '') {
            $image_user = public_path() . '/uploads/events/' . $folder_name . '/' . $image_name;
            if (file_exists($image_user)) {
                unlink($image_user);
            }
        }
        Event_album::where('id', $image_id)->where('event_title_id', $event_title_id)->delete();
        $images = Event_album::where('event_title_id', $event_title_id)->get();
        return ($images);
    }

}
