<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use App\Institute_timing;
use App\Http\Controllers\Controller;

class InstituteTimingsController extends Controller {

    public function add_institute_timings() {
        return view('institute_timings/add_institute_timings');
    }

    public function do_add_institute_timings(Request $request) {
        $this->validate($request, [
            'title' => 'required',
            'class_start' => 'required|unique:institute_timings',
            'class_end' => 'required|after:class_start|unique:institute_timings'
        ]);
        $hours = (new Carbon(date("H:i", strtotime($request['class_end']))))->diff(new Carbon(date("H:i", strtotime($request['class_start']))))->format('%h');
        $minutes = (new Carbon(date("H:i", strtotime($request['class_end']))))->diff(new Carbon(date("H:i", strtotime($request['class_start']))))->format('%I');
        $duration = $hours * 60 + $minutes . '  minutes';
        $created_user_id = Session::get('user_login_id');

        $time_ids = DB::select(DB::raw("SELECT max(id) as time_id FROM institute_timings"));
        if ($time_ids != ''):
            $time_id = $time_ids[0]->time_id;
        else:
            $time_id = 0;
        endif;
        $t = $time_id + 1;
        $academic_year_id = Session::get('academic_year_id');
        $institute_timings = new Institute_timing();
        $institute_timings->title = $request['title'];
        $institute_timings->time_id = $t;
        $institute_timings->class_start = $request['class_start'];
        $institute_timings->class_end = $request['class_end'];
        $institute_timings->duration = $duration;
        $institute_timings->created_user_id = $created_user_id;
        $institute_timings->academic_year_id = $academic_year_id;
        $data = array(
            'log_type' => 'Institute timings added successfully!',
            'message' => 'Added',
            'new_value' => $request['class_start'] . ' to ' . $request['class_end'] . ' , ' . $request['title'] . ' , ' . $duration,
            'old_value' => 'No old values',
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $institute_timings->save();
        return redirect('view-institute-timings')->with(['message-success' => $request['title'] . ' timings from ' . ' ' . $request['class_start'] . ' to ' . $request['class_end'] . ' of duration ' . $duration . ' added successfully.']);
    }

    public function view_institute_timings() {
        $academic_year_id = Session::get('academic_year_id');
        $institute_timings = Institute_timing::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('institute_timings/view_institute_timings', compact('institute_timings'));
    }

    public function edit_institute_timings($institute_timings_id) {
        $institute_timings = Institute_timing::where('id', $institute_timings_id)->get();
        return view('institute_timings/edit_institute_timings', compact('institute_timings'));
    }

    public function do_edit_institute_timings(Request $request, $institute_timings_id) {
        $this->validate($request, [
            'title' => 'required',
            'class_start' => 'required|unique:institute_timings,class_start,' . Institute_timing::where('id', $institute_timings_id)->value('id'),
            'class_end' => 'required|after:class_start|unique:institute_timings,class_end,' . Institute_timing::where('id', $institute_timings_id)->value('id'),
        ]);
        $hours = (new Carbon(date("H:i", strtotime($request['class_end']))))->diff(new Carbon(date("H:i", strtotime($request['class_start']))))->format('%h');
        $minutes = (new Carbon(date("H:i", strtotime($request['class_end']))))->diff(new Carbon(date("H:i", strtotime($request['class_start']))))->format('%I');
        $duration = $hours * 60 + $minutes . '  minutes';
        $created_user_id = Session::get('user_login_id');

        $institute_timings = Institute_timing::find($institute_timings_id);
        $institute_timings->title = $request['title'];
        $institute_timings->class_start = $request['class_start'];
        $institute_timings->class_end = $request['class_end'];
        $institute_timings->duration = $duration;
        $institute_timings->updated_user_id = $created_user_id;
        //$institute_timings->academic_year_id = $academic_year_id;
        $institute_timing = Institute_timing::where('id', $institute_timings_id)->get();
        $data = array(
            'log_type' => 'Institute timings updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['class_start'] . ' to ' . $request['class_end'] . ' , ' . $request['title'] . ' , ' . $duration,
            'old_value' => $institute_timing[0]->title . ' Start ' . $institute_timing[0]->class_start . ' end ' . $institute_timing[0]->class_end . ' duration ' . $institute_timing[0]->duration,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $institute_timings->update();
        return redirect('view-institute-timings')->with(['message-success' => $request['title'] . ' timings from ' . ' ' . $request['class_start'] . ' to ' . $request['class_end'] . ' of duration ' . $duration . ' updated successfully.']);
    }

    public function make_inactive_institute_timings($institute_timings_id) {
        $institute_timing = Institute_timing::where('id', $institute_timings_id)->get();
        Institute_timing::where('id', $institute_timings_id)->update(['status' => 0]);
        return redirect('view-institute-timings')->with(['message-warning' => $institute_timing[0]->title . ' timings from ' . ' ' . $institute_timing[0]->class_start . ' to ' . $institute_timing[0]->class_end . ' of duration ' . $institute_timing[0]->duration . ' inactivated successfully.']);
    }

    public function make_active_institute_timings($institute_timings_id) {
        $institute_timing = Institute_timing::where('id', $institute_timings_id)->get();
        Institute_timing::where('id', $institute_timings_id)->update(['status' => 1]);
        return redirect('view-institute-timings')->with(['message-info' => $institute_timing[0]->title . ' timings from ' . ' ' . $institute_timing[0]->class_start . ' to ' . $institute_timing[0]->class_end . ' of duration ' . $institute_timing[0]->duration . ' activated successfully.']);
    }

    public function delete_institute_timings($institute_timings_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $institute_timing = Institute_timing::where('id', $institute_timings_id)->get();
        $data = array(
            'log_type' => 'Institute timings deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $institute_timing[0]->title . ' Start ' . $institute_timing[0]->class_start . ' end ' . $institute_timing[0]->class_end . ' duration ' . $institute_timing[0]->duration,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Institute_timing::where('id', $institute_timings_id)->delete();
        return redirect('view-institute-timings')->with(['message-danger' => $institute_timing[0]->title . ' timings from ' . ' ' . $institute_timing[0]->class_start . ' to ' . $institute_timing[0]->class_end . ' of duration ' . $institute_timing[0]->duration . ' deleted successfully.']);
    }

}
