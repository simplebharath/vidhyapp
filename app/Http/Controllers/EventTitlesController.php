<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Event_title;
use App\Http\Controllers\Controller;

class EventTitlesController extends Controller {

    public function add_event_title() {
        return view('event_titles/add_event_title');
    }

    public function do_add_event_title(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:event_titles',
        ]);
        $foldername = substr($request->input('title'), 0, 3) . rand();
        $event_titles = new Event_title();
        $event_titles->title = $request['title'];
        $event_titles->foldername = $foldername;
        $event_titles->created_user_id = $created_user_id;
        $event_titles->academic_year_id = $academic_year_id;
        $event_titles->save();
        $data = array(
            'log_type' => ' Event Titles added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-event-titles')->with(['message-success' => 'Event Titles' . $request['title'] . ' added successfully.']);
    }

    public function view_event_titles() {
        $event_titles = Event_title::orderBy('created_at', 'desc')->get();
        return view('event_titles/view_event_titles', compact('event_titles'));
    }

    public function edit_event_title($event_title_id) {
        $event_titles = Event_title::where('id', $event_title_id)->get();
        return view('event_titles/edit_event_title', compact('event_titles'));
    }

    public function do_edit_event_title(Request $request, $event_title_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:event_titles,title,',
        ]);
        $event_titles = Event_title::find($event_title_id);
        $event_titles->title = $request['title'];
        $event_titles->updated_user_id = $created_user_id;
        $event_titles->academic_year_id = $academic_year_id;
        $old_values = Event_title::find($event_title_id);

        $data = array(
            'log_type' => 'Event Title updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $event_titles->update();
        return redirect('view-event-titles')->with(['message-success' => 'Event Title ' . $request['title'] . ' updated successfully.']);
    }

    public function delete_event_title($event_title_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Event_title::where('id', $event_title_id)->get();
        $data = array(
            'log_type' => 'Event Title deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Event_title::where('id', $event_title_id)->delete();
        return redirect('view-event-titles')->with(['message-danger' => 'Event Title deleted successfully.']);
    }

    public function make_inactive_event_title($event_title_id) {
        Event_title::where('id', $event_title_id)->update(['status' => 0]);
        return redirect('view-event-titles')->with(['message-warning' => 'Event Title  inactivated successfully.']);
    }

    public function make_active_event_title($event_title_id) {
        Event_title::where('id', $event_title_id)->update(['status' => 1]);
        return redirect('view-event-titles')->with(['message-info' => 'Event Title  activated successfully.']);
    }

}
