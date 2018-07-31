<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Grade_type;
use App\Http\Controllers\Controller;

class GradeController extends Controller {

    public function add_grade_type() {
        return view('grades/add_grade');
    }

    public function do_grade_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:grade_types',
        ]);
        $grade_type = new Grade_type();
        $grade_type->title = $request['title'];
        $grade_type->created_user_id = $created_user_id;
        $grade_type->academic_year_id = $academic_year_id;
        $grade_type->save();
        $data = array(
            'log_type' => ' Grade Type added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-grade-types')->with(['message-success' => 'Grade Type ' . $request['title'] . ' added successfully.']);
    }

    public function view_grade_types() {
        $grade_types = Grade_type::orderBy('created_at', 'desc')->get();
        return view('grades/view_grade', compact('grade_types'));
    }

    public function edit_grade_type($grade_type_id) {
        $grade_type = grade_type::where('id', $grade_type_id)->get();
        return view('grades/edit_grade', compact('grade_type'));
    }

    public function do_edit_grade_type(Request $request, $grade_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:grade_types,title,' . grade_type::where('id', $grade_type_id)->value('id'),
        ]);
        $grade_type = grade_type::find($grade_type_id);
        $grade_type->title = $request['title'];
        $grade_type->updated_user_id = $grade_type_id;
        //$grade_type->academic_year_id = $academic_year_id;        
        $old_values = grade_type::find($grade_type_id);

        $data = array(
            'log_type' => 'Grade types updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $grade_type->update();
        return redirect('view-grade-types')->with(['message-success' => 'Grade type' . $request['title'] . ' updated successfully.']);
    }

    public function make_active_grade_type($grade_type_id) {
        $title = grade_type::where('id', $grade_type_id)->value('title');
        grade_type::where('id', $grade_type_id)->update(['status' => 1]);
        return redirect('view-grade-types')->with(['message-info' => 'Grade type ' . $title . ' activated successfully.']);
    }

    public function delete_grade_type($grade_type_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = grade_type::where('id', $grade_type_id)->value('title');
        $old_values = grade_type::where('id', $grade_type_id)->get();
        $data = array(
            'log_type' => 'Grade Type deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        grade_type::where('id', $grade_type_id)->delete();
        return redirect('view-grade-types')->with(['message-danger' => 'Grade Type ' . $title . ' deleted successfully.']);
    }

    public function add_grade_settings() {
        return view('grade_settings/add_grade_settings');
    }

    public function view_grade_settings() {
        return view('grade_settings/view_grade_settings');
    }

    public function edit_grade_settings($grade_settings_id) {
        return view('grade_settings/edit_grade_settings');
    }

    public function make_inactive_grade_type($grade_type_id) {
        $title = grade_type::where('id', $grade_type_id)->value('title');
        grade_type::where('id', $grade_type_id)->update(['status' => 0]);
        return redirect('view-grade-types')->with(['message-warning' => 'Grade type ' . $title . ' inactivated successfully.']);
    }

}
