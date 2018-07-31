<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Grade_setting;
use App\Http\Controllers\Controller;

class GradeSettingsController extends Controller {

    public function add_grade_settings() {
        $percentages = DB::select(DB::raw("SELECT id,percentage_from,percentage_to FROM `percentages` where id NOT IN(SELECT percentage_id from grade_settings ) AND status=1"));
        $grade_types = DB::select(DB::raw("SELECT id,title FROM `grade_types`where id NOT IN(SELECT grade_type_id from grade_settings ) AND status=1"));
        return view('grade_settings/add_grade_settings', compact('percentages', 'grade_types'));
    }

    public function do_grade_settings(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $percentage = \App\Percentages::where('id', $request['percentage_id'])->value('percentage_from');
        $grade = \App\Grade_type::where('id', $request['grade_type_id'])->value('title');
        $this->validate($request, [
            'percentage_id' => 'required|unique:grade_settings',
            'grade_type_id' => 'required|unique:grade_settings'
        ]);
        $grade_type = new Grade_setting();
        $grade_type->percentage_id = $request['percentage_id'];
        $grade_type->grade_type_id = $request['grade_type_id'];
        $grade_type->created_user_id = $created_user_id;
        $grade_type->academic_year_id = $academic_year_id;
        $grade_type->save();
        $data = array(
            'log_type' => ' Grade settings  added  successfully!',
            'message' => 'Added',
            'new_value' => $percentage . '' . $grade,
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-grade-settings')->with(['message-success' => 'Grade settings ' . $percentage . ' - ' . $grade . ' added successfully.']);
    }

    public function view_grade_settings() {
        $grade_types = Grade_setting::orderBy('created_at', 'desc')->get();
        return view('grade_settings/view_grade_settings', compact('grade_types'));
    }

    public function edit_grade_settings($grade_settings_id) {
        $grade_settings = Grade_setting::where('id', $grade_settings_id)->get();
        $percentage_id = $grade_settings[0]->percentage_id;
        $percentages = \App\Percentages::where('id', $percentage_id)->get();
        $grade_types = DB::select(DB::raw("SELECT id,title FROM `grade_types`where id NOT IN(SELECT grade_type_id from grade_settings  WHERE id != $grade_settings_id ) AND status=1"));
        return view('grade_settings/edit_grade_settings', compact('percentages', 'grade_types', 'grade_settings'));
    }

    public function do_edit_grade_settings(Request $request, $grade_settings_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'grade_type_id' => 'required|unique:grade_settings,grade_type_id,' . Grade_setting::where('id', $grade_settings_id)->value('id'),
            'percentage_id' => 'required|unique:grade_settings,percentage_id,' . Grade_setting::where('id', $grade_settings_id)->value('id'),
        ]);
        $grade_settings = Grade_setting::find($grade_settings_id);
        $grade_settings->grade_type_id = $request['grade_type_id'];
        $grade_settings->percentage_id = $request['percentage_id'];
        $grade_settings->updated_user_id = $created_user_id;
        //$grade_settings->academic_year_id = $academic_year_id;
        $old_values = Grade_setting::find($grade_settings_id);
        $grade = \App\Grade_type::where('id', $request['grade_type_id'])->value('title');
        $percentage = \App\Percentages::where('id', $request['percentage_id'])->value('percentage_from');
        $data = array(
            'log_type' => 'Grade settings updated successfully!',
            'message' => 'Updated',
            'new_value' => $grade . ' ' . $percentage,
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $grade_settings->update();
        return redirect('view-grade-settings')->with(['message-success' => 'Grade setting ' . $grade . ' ' . $percentage . ' updated successfully.']);
    }

    public function delete_grade_settings($grade_settings_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Grade_setting::where('id', $grade_settings_id)->get();
        $g_id = $old_values[0]->grade_type_id;
        $p_id = $old_values[0]->percentage_id;
        $grade = \App\Grade_type::where('id', $g_id)->value('title');
        $percentage = \App\Percentages::where('id', $p_id)->value('percentage_from');
        $data = array(
            'log_type' => 'Grade setting deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $grade . ' ' . $percentage,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Grade_setting::where('id', $grade_settings_id)->delete();
        return redirect('view-grade-settings')->with(['message-danger' => 'Grade setting ' . $grade . ' ' . $percentage . ' deleted successfully.']);
    }

    public function make_inactive_grade_settings($grade_settings_id) {
        $old_values = Grade_setting::where('id', $grade_settings_id)->get();
        $g_id = $old_values[0]->grade_type_id;
        $p_id = $old_values[0]->percentage_id;
        $grade = \App\Grade_type::where('id', $g_id)->value('title');
        $percentage = \App\Percentages::where('id', $p_id)->value('percentage_from');
        Grade_setting::where('id', $grade_settings_id)->update(['status' => 0]);
        return redirect('view-grade-settings')->with(['message-warning' => 'Grade settings type ' . $grade . ' ' . $percentage . ' inactivated successfully.']);
    }

    public function make_active_grade_settings($grade_settings_id) {
        $old_values = Grade_setting::where('id', $grade_settings_id)->get();
        $g_id = $old_values[0]->grade_type_id;
        $p_id = $old_values[0]->percentage_id;
        $grade = \App\Grade_type::where('id', $g_id)->value('title');
        $percentage = \App\Percentages::where('id', $p_id)->value('percentage_from');
        Grade_setting::where('id', $grade_settings_id)->update(['status' => 1]);
        return redirect('view-grade-settings')->with(['message-info' => 'Grade settings type ' . $grade . ' ' . $percentage . ' activated successfully.']);
    }

}
