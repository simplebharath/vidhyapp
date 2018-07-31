<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StaffQualificationsController extends Controller {

    public function add_staff_qualification(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $uri = $request->path();
            $url_parts = explode('/', $uri);
            $staff_id = $url_parts[1];
            $staff = \App\Staff::where('id', $staff_id)->get();
            $staff_qualifications = \App\Staff_qualification::where('staff_id', $staff[0]->staff_id)->paginate(10);
            if (COUNT($staff) != 1):
                return redirect('add-staff');
            endif;
            return view('staff_qualifications/add_staff_qualification', compact('staff', 'staff_qualifications'));
        } else {
            return redirect('view-staff');
        }
    }

    public function view_staff_qualifications($staff_id) {
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
        $staff_qualifications = \App\Staff_qualification::where('staff_id', $staffs[0]->staff_id)->get();
        return view('staff_qualifications/view_staff_qualification', compact('staffs', 'institute_details', 'staff_qualifications', 'no_classes'));
    }

    public function edit_staff_qualification($staff_id, $staff_qualification_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $staff = \App\Staff::where('id', $staff_id)->get();
            $staff_qualifications = \App\Staff_qualification::where('id', $staff_qualification_id)->get();
            return view('staff_qualifications/edit_staff_qualification', compact('staff', 'staff_qualifications'));
        } else {
            return redirect('view-staff');
        }
    }

    public function do_add_staff_qualification(Request $request, $staff_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'qualification' => 'required',
            'institute_name' => 'required',
            'course_name' => 'required',
            'stream_branch' => 'required',
            'percentage' => 'required',
        ]);
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $staff_qualifications = new \App\Staff_qualification();
        $staff_qualifications->qualification = $request['qualification'];
        $staff_qualifications->institute_name = $request['institute_name'];
        $staff_qualifications->course_name = $request['course_name'];
        $staff_qualifications->stream_branch = $request['stream_branch'];
        $staff_qualifications->percentage = $request['percentage'];
        $staff_qualifications->staff_id = $staffs[0]->staff_id;
        $staff_qualifications->created_user_id = $created_user_id;
        $staff_qualifications->academic_year_id = $academic_year_id;
        $staff_qualifications->save();
        $data = array(
            'log_type' => ' Staff added successfully!',
            'message' => 'Added',
            'new_value' => $request['qualification'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('add-staff-qualification/' . $staff_id)->with(['message-success' => 'Qualification ' . $request['qualification'] . ' added successfully.']);
    }

    public function do_edit_staff_qualification(Request $request, $staff_id, $staff_qualification_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'qualification' => 'required',
            'institute_name' => 'required',
            'course_name' => 'required',
            'stream_branch' => 'required',
            'percentage' => 'required',
        ]);
        $staff_qualifications = \App\Staff_qualification::find($staff_qualification_id);
        $staff_qualifications->qualification = $request['qualification'];
        $staff_qualifications->institute_name = $request['institute_name'];
        $staff_qualifications->course_name = $request['course_name'];
        $staff_qualifications->stream_branch = $request['stream_branch'];
        $staff_qualifications->percentage = $request['percentage'];
        //$staff_qualifications->staff_id = $staff_id;
        $staff_qualifications->updated_user_id = $created_user_id;
        $staff_qualifications->academic_year_id = $academic_year_id;

        $data = array(
            'log_type' => 'Staff qualification  updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['qualification'],
            'old_value' => \App\Staff_qualification::where('id', $staff_qualification_id)->get(),
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff_qualifications->update();
        return redirect('add-staff-qualification/' . $staff_id)->with(['message-success' => 'Staff qualification' . $request['qualification'] . ' updated successfully.']);
    }

    public function delete_staff_qualification($staff_id, $staff_qualification_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = \App\Staff_qualification::where('id', $staff_qualification_id)->get();
        $data = array(
            'log_type' => 'Staff qualification deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $qulification = \App\Staff_qualification::where('id', $staff_qualification_id)->value('qualification');
        \App\Staff_qualification::where('id', $staff_qualification_id)->delete();
        return redirect('add-staff-qualification/' . $staff_id)->with(['message-danger' => 'Staff qualification ' . $qulification . ' deleted successfully.']);
    }

}
