<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Video;
use App\Http\Controllers\Controller;

class VideosController extends Controller {

    public function add_video() {
        return view('videos/add_video');
    }

    public function do_add_video(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required',
            'video' => 'required',
        ]);
        $videos = new Video();
        $videos->title = $request['title'];
        $videos->video = $request['video'];
        $videos->description = $request['description'];
        $videos->created_user_id = $created_user_id;
        $videos->academic_year_id = $academic_year_id;
        $videos->save();
        $data = array(
            'log_type' => ' Video added successfully!',
            'message' => 'Added',
            'new_value' => $request['video'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-videos')->with(['message-success' => 'Video' . $request['video'] . ' added successfully.']);
    }
     public function do_update_video(Request $request,$video_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required',
            'video' => 'required',
        ]);
        $videos = Video::find($video_id);
        $videos->title = $request['title'];
        $videos->video = $request['video'];
        $videos->description = $request['description'];
        $videos->updated_user_id = $created_user_id;
        $videos->academic_year_id = $academic_year_id;
        $videos->update();
        $data = array(
            'log_type' => ' Video updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['video'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-videos')->with(['message-success' => 'Video' . $request['video'] . ' updated successfully.']);
    }

    public function view_videos() {
        $academic_year_id = Session::get('academic_year_id');
        if(Session::get('user_type_id')==1){
        $videos = Video::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->paginate(2);
        }else{
        $videos = Video::where('academic_year_id', $academic_year_id)->where('status',1)->orderBy('created_at', 'desc')->paginate(4);
        }
        return view('videos/view_videos', compact('videos'));
    }
    
    public function change_access_status(Request $request,$video_id) {
        $public=$request['public'];
        if($public == 1){
        Video::where('id', $video_id)->update(['status' => 0]);
        }else{
             Video::where('id', $video_id)->update(['status' => 1]);
        }
        return redirect('view-videos')->with(['message-success' => 'Video accesses changed successfully!']);
    }
    
    public function delete_video($video_id) {
     
        Video::where('id', $video_id)->delete();
        
        return redirect('view-videos')->with(['message-success' => 'Video deleted successfully!']);
    }

}
