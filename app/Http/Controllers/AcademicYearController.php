<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Academic_year;
use App\Http\Controllers\Controller;

class AcademicYearController extends Controller {

    public function add_academic_year() {
        return view('acadamicyear/add_academic_year');
    }

    public function do_add_academic_year(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required|after:from_date'
        ]);
        $f_date = $request['from_date'];
        $to_date = $request['to_date'];
        $years = new Academic_year();
        $years->from_date = date("Y-m-d", strtotime($request['from_date']));
        $years->to_date = date("Y-m-d", strtotime($request['to_date']));
        $years->created_user_id = $created_user_id;
        $years->save();
        $data = array(
            'log_type' => 'Academic year added successfully!',
            'message' => 'Added',
            'new_value' => $request['from_date'] . '-' . $request['to_date'],
            'old_value' => 'No old values',
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-academic-years')->with(['message-success' => 'Academic year ' . ' ' . $f_date . ' - ' . $to_date . ' added successfully.']);
    }

    public function view_academic_years() {
        $years = Academic_year::orderBy('created_at', 'DESC')->get();
        return view('acadamicyear/view_academic_year', compact('years'));
    }

    public function edit_academic_year($year_id) {
        $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id FROM academic_years WHERE id=$year_id "));
        return view('acadamicyear/edit_academic_year', compact('years'));
    }

    public function do_edit_academic_year(Request $request, $year_id) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required|after:from_date'
        ]);
        $f_date = $request['from_date'];
        $to_date = $request['to_date'];
        $years = Academic_year::find($year_id);
        $years->from_date = date("Y-m-d", strtotime($request['from_date']));
        $years->to_date = date("Y-m-d", strtotime($request['to_date']));
        $years->created_user_id = $created_user_id;

        $old_values = Academic_year::where('id', $year_id)->get();
        $data = array(
            'log_type' => 'Academic year updated successfully!',
            'message' => 'Added',
            'new_value' => $f_date . '-' . $to_date,
            'old_value' => $old_values,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $years->update();
        return redirect('view-academic-years')->with(['message-success' => 'Academic year ' . ' ' . $f_date . ' - ' . $to_date . ' updated successfully.']);
    }

    public function make_inactive_year($year_id) {
        $from = Academic_year::where('id', $year_id)->value('from_date');
        $to = Academic_year::where('id', $year_id)->value('to_date');
        Academic_year::where('id', $year_id)->update(['status' => 0]);
        return redirect('view-academic-years')->with(['message-warning' => 'Academic year ' . $from . ' - ' . $to . ' inactivated successfully.']);
    }

    public function make_active_year($year_id) {
        $from = Academic_year::where('id', $year_id)->value('from_date');
        $to = Academic_year::where('id', $year_id)->value('to_date');
        Academic_year::where('id', $year_id)->update(['status' => 1]);
        return redirect('view-academic-years')->with(['message-info' => 'Academic year ' . $from . ' - ' . $to . ' activated successfully.']);
    }

    public function delete_academic_year($year_id) {
        $from = Academic_year::where('id', $year_id)->value('from_date');
        $to = Academic_year::where('id', $year_id)->value('to_date');
        $old_values = Academic_year::where('id', $year_id)->get();
        $created_user_id = Session::get('user_login_id');

        $data = array(
            'log_type' => 'Academic year deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Academic_year::where('id', $year_id)->delete();
        return redirect('view-academic-years')->with(['message-danger' => 'Academic year ' . $from . ' - ' . $to . ' deleted successfully.']);
    }

}
