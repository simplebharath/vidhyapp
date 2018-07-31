<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Album;
use App\Http\Controllers\Controller;

class AlbumController extends Controller {

    public function add_album() {
        return view('albums/add_album');
    }

    public function do_add_album(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'album_title' => 'required|min:3|unique:albums',
                //'foldername' => 'required',
        ]);
        $foldername = substr($request->input('album_title'), 0, 3) . rand();
        $albums = new Album();
        $albums->album_title = $request['album_title'];
        $albums->foldername = $foldername;
        $albums->album_description = $request['album_description'];
        $albums->created_user_id = $created_user_id;
        $albums->academic_year_id = $academic_year_id;
        $albums->save();
        $data = array(
            'log_type' => ' Album  Title added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-albums')->with(['message-success' => 'Album Title added successfully.']);
    }

    public function view_albums() {
        $academic_year_id = Session::get('academic_year_id');
        $albums = Album::orderBy('created_at', 'desc')->get();
        return view('albums/view_album', compact('albums'));
    }

    public function edit_album($album_id) {
        $albums = Album::where('id', $album_id)->get();
        return view('albums/edit_album', compact('albums'));
    }

    public function do_edit_album(Request $request, $album_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'album_title' => 'required|min:3|unique:albums,album_title,' . Album::where('id', $album_id)->value('id'),
        ]);
        $albums = Album::find($album_id);
        $albums->album_title = $request['album_title'];
        $albums->updated_user_id = $created_user_id;
        // $albums->academic_year_id = $academic_year_id;
        $old_values = Album::find($album_id);

        $data = array(
            'log_type' => 'Album added successfully!',
            'message' => 'Added',
            'new_value' => $request['album_title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $albums->update();
        return redirect('view-albums')->with(['message-success' => 'Album ' . $request['album_title'] . ' updated successfully.']);
    }

    public function delete_album($album_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Album::where('id', $album_id)->get();
        $data = array(
            'log_type' => 'Album deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Album::where('id', $album_id)->delete();
        return redirect('view-albums')->with(['message-danger' => 'Album  deleted successfully.']);
    }

    public function make_inactive_album($album_id) {
        Album::where('id', $album_id)->update(['status' => 0]);
        return redirect('view-albums')->with(['message-warning' => 'Album access changed to private']);
    }

    public function make_active_album($album_id) {
        Album::where('id', $album_id)->update(['status' => 1]);
        return redirect('view-albums')->with(['message-info' => 'Album access changed to public']);
    }

}
