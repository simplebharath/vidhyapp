<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Institute_holiday;
use App\Http\Controllers\Controller;

class InstituteHolidaysController extends Controller {

    public function add_institute_holiday() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-institute-holidays');
        } else {
            return view('institute_holidays/add_institute_holiday');
        }
    }

    public function do_add_institute_holiday(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:institute_holidays',
            'holiday_date' => 'required|unique:institute_holidays',
        ]);
        $institute_holidays = new Institute_holiday();
        $institute_holidays->title = $request['title'];
        $institute_holidays->holiday_date = $request['holiday_date'];
        $institute_holidays->created_user_id = $created_user_id;
        $institute_holidays->academic_year_id = $academic_year_id;
        $institute_holidays->save();
        //calendar

        $data = array(
            'log_type' => ' class added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'] . ' ' . $request['holiday_date'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-institute-holidays')->with(['message-success' => 'Holiday ' . $request['title'] . ' on ' . $request['holiday_date'] . ' added successfully.']);
    }

    public function view_institute_holidays() {
        $institute_holidays = Institute_holiday::orderBy('created_at', 'desc')->get();
        return view('institute_holidays/view_institute_holidays', compact('institute_holidays'));
    }

    public function edit_institute_holiday($institute_holiday_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $institute_holidays = Institute_holiday::where('id', $institute_holiday_id)->get();
            return view('institute_holidays/edit_institute_holiday', compact('institute_holidays'));
        } else {
            return redirect('view-institute-holidays');
        }
    }

    public function do_edit_institute_holiday(Request $request, $institute_holiday_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:institute_holidays,title,' . Institute_holiday::where('id', $institute_holiday_id)->value('id'),
            'holiday_date' => 'required|unique:institute_holidays,holiday_date,' . Institute_holiday::where('id', $institute_holiday_id)->value('id'),
        ]);
        $institute_holidays = Institute_holiday::find($institute_holiday_id);
        $institute_holidays->title = $request['title'];
        $institute_holidays->holiday_date = $request['holiday_date'];
        $institute_holidays->updated_user_id = $created_user_id;
        // $institute_holidays->academic_year_id = $academic_year_id;
        $old_values = Institute_holiday::find($institute_holiday_id);

        $data = array(
            'log_type' => 'Holiday updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['title'] . ' ' . $request['holiday_date'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $institute_holidays->update();
        return redirect('view-institute-holidays')->with(['message-success' => 'Holiday ' . $request['title'] . ' on ' . $request['holiday_date'] . ' updated successfully.']);
    }

    public function make_inactive_institute_holiday($institute_holiday_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $titles = Institute_holiday::where('id', $institute_holiday_id)->get();
            Institute_holiday::where('id', $institute_holiday_id)->update(['status' => 0]);
            return redirect('view-institute-holidays')->with(['message-warning' => 'Holiday ' . $titles[0]->title . ' on ' . $titles[0]->holiday_date . ' inactivated successfully.']);
        } else {
            return redirect('view-institute-holidays');
        }
    }

    public function make_active_institute_holiday($institute_holiday_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $titles = Institute_holiday::where('id', $institute_holiday_id)->get();
            Institute_holiday::where('id', $institute_holiday_id)->update(['status' => 1]);
            return redirect('view-institute-holidays')->with(['message-info' => 'Holiday ' . $titles[0]->title . ' on ' . $titles[0]->holiday_date . ' activated successfully.']);
        } else {
            return redirect('view-institute-holidays');
        }
    }

    public function delete_institute_holiday($institute_holiday_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($delete == 1) && ($view == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $titles = Institute_holiday::where('id', $institute_holiday_id)->get();
            $old_values = Institute_holiday::where('id', $institute_holiday_id)->get();
            $data = array(
                'log_type' => 'Holiday deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Institute_holiday::where('id', $institute_holiday_id)->delete();
            return redirect('view-institute-holidays')->with(['message-danger' => 'Holiday ' . $titles[0]->title . ' on ' . $titles[0]->holiday_date . ' deleted successfully.']);
        } else {
            return redirect('view-institute-holidays');
        }
    }

}
