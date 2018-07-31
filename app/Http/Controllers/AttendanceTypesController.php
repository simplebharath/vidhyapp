<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Attendance_type;
use App\Http\Controllers\Controller;

class AttendanceTypesController extends Controller {

    public function add_attendance_type() {
        return view('attendance/add_attendance_type');
    }

    public function do_attendance_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:attendance_types',
        ]);
        $attendance_types = new Attendance_type();
        $attendance_types->title = $request['title'];
        $attendance_types->created_user_id = $created_user_id;
        $attendance_types->academic_year_id = $academic_year_id;
        $attendance_types->save();
        $data = array(
            'log_type' => ' Attendance types added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-attendance-types')->with(['message-success' => 'Attendance type' . $request['title'] . ' added successfully.']);
    }

    public function view_attendance_types() {
        $attendance_types = Attendance_type::orderBy('created_at', 'desc')->get();
        return view('attendance/view_attendance_type', compact('attendance_types'));
    }

    public function edit_attendance_type($attendance_type_id) {
        $attendance_types = Attendance_type::where('id', $attendance_type_id)->get();
        return view('attendance/edit_attendance_type', compact('attendance_types'));
    }

    public function do_edit_attendance_type(Request $request, $attendance_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:attendance_types,title,' . attendance_type::where('id', $attendance_type_id)->value('id'),
        ]);
        $attendance_types = Attendance_type::find($attendance_type_id);
        $attendance_types->title = $request['title'];
        $attendance_types->updated_user_id = $created_user_id;
        //$attendance_types->academic_year_id = $academic_year_id;
        $old_values = Attendance_type::find($attendance_type_id);

        $data = array(
            'log_type' => 'Attendance types updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $attendance_types->update();
        return redirect('view-attendance-types')->with(['message-success' => 'Attendance type ' . $request['title'] . ' updated successfully.']);
    }

    public function make_inactive_attendance_type($attendance_type_id) {
        $title = Attendance_type::where('id', $attendance_type_id)->value('title');
        Attendance_type::where('id', $attendance_type_id)->update(['status' => 0]);
        return redirect('view-attendance-types')->with(['message-warning' => 'Attendance type ' . $title . ' inactivated successfully.']);
    }

    public function make_active_attendance_type($attendance_type_id) {
        $title = Attendance_type::where('id', $attendance_type_id)->value('title');
        Attendance_type::where('id', $attendance_type_id)->update(['status' => 1]);
        return redirect('view-attendance-types')->with(['message-info' => 'Attendance type ' . $title . ' activated successfully.']);
    }

    public function delete_attendance_type($attendance_type_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = Attendance_type::where('id', $attendance_type_id)->value('title');
        $old_values = Attendance_type::where('id', $attendance_type_id)->get();
        $data = array(
            'log_type' => 'User Type deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Attendance_type::where('id', $attendance_type_id)->delete();
        return redirect('view-attendance-types')->with(['message-danger' => 'Attendance type ' . $title . ' deleted successfully.']);
    }

}
