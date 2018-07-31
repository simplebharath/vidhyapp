<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use \Input as Input;
use App\Event;
use App\Http\Controllers\Controller;

class EventsController extends Controller {

    public function view_events() {
        $academic_year_id = Session::get('academic_year_id');
        $events = Event::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('events/view_events', compact('events'));
    }

    public function add_event() {
        $events = \App\Event_title::where('status', '1')->get();
        return view('events/add_event', compact('events'));
    }

    public function do_add_event(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'event_title_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required',
                //'event_poster' => 'mimes:jpeg,bmp,png,jpg',
        ]);
        $events = new Event();
        $events->event_title_id = $request['event_title_id'];
        $events->start_time = $request['start_time'];
        $events->end_time = $request['end_time'];
        $events->venue = $request['venue'];
        //$events->event_poster = $request['event_poster'];
        $events->description = $request['description'];
        $events->created_user_id = $created_user_id;
        $events->academic_year_id = $academic_year_id;

        if ($request->hasFile('event_poster')) {
            $file = Input::file('event_poster');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/events/', $name);
            $events->event_poster = $name;
        }
        $events->save();
        $data = array(
            'log_type' => ' Events added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-events')->with(['message-success' => 'Events added successfully.']);
    }

    public function edit_event($event_id) {
        $events = Event::where('id', $event_id)->get();
        return view('events/edit_event', compact('events'));
    }

    public function do_edit_event(Request $request, $event_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'event_title_id' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
            'venue' => 'required',
        ]);

        $events = Event::find($event_id);
        $events->event_title_id = $request['event_title_id'];
        $events->start_time = $request['start_time'];
        $events->end_time = $request['end_time'];
        $events->venue = $request['venue'];
        //$events->event_poster = $request['event_poster'];
        $events->description = $request['description'];
        $events->created_user_id = $created_user_id;
        $events->academic_year_id = $academic_year_id;
        $old_values = Event::find($event_id);

        if ($request->hasFile('event_poster')) {
            $image = $old_values->event_poster;
            if ($image != '') {
                $image_staff = public_path() . '/uploads/events/' . $image;
                if (file_exists($image_staff)) {
                    unlink($image_staff);
                }
            }
            $file = Input::file('event_poster');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/events/', $name);
            $events->event_poster = $name;
        }
        $data = array(
            'log_type' => 'Event updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $events->update();
        return redirect('view-events')->with(['message-success' => 'Event  updated successfully.']);
    }

    public function delete_event($event_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Event::where('id', $event_id)->get();
        $data = array(
            'log_type' => 'Event deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Event::where('id', $event_id)->delete();
        return redirect('view-events')->with(['message-danger' => 'Event  deleted successfully.']);
    }

    public function make_inactive_event($event_id) {
        Event::where('id', $event_id)->update(['status' => 0]);
        return redirect('view-events')->with(['message-warning' => 'Event  inactivated successfully.']);
    }

    public function make_active_event($event_id) {
        Event::where('id', $event_id)->update(['status' => 1]);
        return redirect('view-events')->with(['message-info' => 'Event  activated successfully.']);
    }

}
