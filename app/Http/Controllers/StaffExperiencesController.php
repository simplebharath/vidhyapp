<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StaffExperiencesController extends Controller {

    public function add_staff_experience(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $uri = $request->path();
            $url_parts = explode('/', $uri);
            $staff_id = $url_parts[1];
            $staff = \App\Staff::where('id', $staff_id)->get();
            $staff_experiences = \App\Staff_experience::where('staff_id', $staff[0]->staff_id)->orderBy('created_at', 'desc')->paginate(10);
            if (COUNT($staff) != 1):
                return redirect('add-staff');
            endif;
            return view('staff_experiences/add_staff_experience', compact('staff', 'staff_experiences'));
        } else {
            return redirect('view-staff');
        }
    }

    public function view_staff_experiences($staff_id) {
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
        }
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
        if ($classes != ''):
            $no_classes = $classes[0]->subjects;
        else:
            $no_classes = 0;
        endif;
        $staff_experiences = \App\Staff_experience::where('staff_id', $staffs[0]->staff_id)->orderBy('created_at', 'desc')->paginate(10);
        return view('staff_experiences/view_staff_experiences', compact('staffs', 'institute_details', 'staff_experiences', 'no_classes'));
    }

    public function do_add_staff_experience(Request $request, $staff_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'organisation_name' => 'required',
            'position' => 'required',
            'from_year' => 'required',
            'to_year' => 'required',
            'total_years' => 'required',
        ]);
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $staff_experiences = new \App\Staff_experience();
        $staff_experiences->organisation_name = $request['organisation_name'];
        $staff_experiences->position = $request['position'];
        $staff_experiences->from_year = $request['from_year'];
        $staff_experiences->to_year = $request['to_year'];
        $staff_experiences->total_years = $request['total_years'];
        $staff_experiences->staff_id = $staffs[0]->staff_id;
        $staff_experiences->created_user_id = $created_user_id;
        $staff_experiences->academic_year_id = $academic_year_id;
        $staff_experiences->save();

        $data = array(
            'log_type' => ' Staff experience added successfully!',
            'message' => 'Added',
            'new_value' => $request['organisation_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('add-staff-experience/' . $staff_id)->with(['message-success' => 'Experience in ' . $request['organisation_name'] . ' added successfully.']);
    }

    public function edit_staff_experience($staff_id, $staff_experience_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $staff = \App\Staff::where('id', $staff_id)->get();
            $staff_experiences = \App\Staff_experience::where('id', $staff_experience_id)->paginate(10);
            return view('staff_experiences/edit_staff_experience', compact('staff', 'staff_experiences'));
        } else {
            return redirect('view-staff');
        }
    }

    public function do_edit_staff_experience(Request $request, $staff_id, $staff_experience_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'organisation_name' => 'required',
            'position' => 'required',
            'from_year' => 'required',
            'to_year' => 'required',
            'total_years' => 'required',
        ]);
        $staff_experiences = \App\Staff_experience::find($staff_experience_id);
        $staff_experiences->organisation_name = $request['organisation_name'];
        $staff_experiences->position = $request['position'];
        $staff_experiences->from_year = $request['from_year'];
        $staff_experiences->to_year = $request['to_year'];
        $staff_experiences->total_years = $request['total_years'];
        // $staff_experiences->staff_id = $staff_id;
        $staff_experiences->updated_user_id = $created_user_id;
        $staff_experiences->academic_year_id = $academic_year_id;

        $data = array(
            'log_type' => 'Staff experience  updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['organisation_name'],
            'old_value' => \App\Staff_experience::where('id', $staff_experience_id)->get(),
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff_experiences->update();
        return redirect('add-staff-experience/' . $staff_id)->with(['message-success' => 'Staff organisation ' . $request['organisation_name'] . ' details updated successfully.']);
    }

    public function delete_staff_experience($staff_id, $staff_experience_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = \App\Staff_experience::where('id', $staff_experience_id)->get();
        $data = array(
            'log_type' => 'Staff experience details deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $experience = \App\Staff_experience::where('id', $staff_experience_id)->value('organisation_name');
        \App\Staff_experience::where('id', $staff_experience_id)->delete();
        return redirect('add-staff-experience/' . $staff_id)->with(['message-danger' => 'Staff experience in ' . $experience . ' deleted successfully.']);
    }

}
