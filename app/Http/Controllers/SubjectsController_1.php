<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Subject;
use App\Http\Controllers\Controller;

class SubjectsController extends Controller {

    public function add_subject() {
        $add = Session::get('add');
        if ($add == 1) {
            return view('subject/add_subject');
        } else {
            return redirect('view-subjects');
        }
    }

    public function do_add_subject(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'subject_name' => 'required|unique:subjects',
        ]);
        $subjects = new Subject();
        $subjects->subject_name = $request['subject_name'];
        $subjects->created_user_id = $created_user_id;
        $subjects->academic_year_id = $academic_year_id;
        $subjects->save();
        $data = array(
            'log_type' => ' subject added successfully!',
            'message' => 'Added',
            'new_value' => $request['subject_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-subjects')->with(['message-success' => 'subject ' . $request['subject_name'] . ' added successfully.']);
    }

    public function view_subjects() {
        $subjects = Subject::orderBy('created_at', 'desc')->get();
        return view('subject/view_subjects', compact('subjects'));
    }

    public function edit_subject($subject_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $subjects = Subject::where('id', $subject_id)->get();
            return view('subject/edit_subject', compact('subjects'));
        } else {
            return redirect('view-subjects');
        }
    }

    public function do_edit_subject(Request $request, $subject_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'subject_name' => 'required|unique:subjects,subject_name,' . Subject::where('id', $subject_id)->value('id'),
        ]);
        $subjects = Subject::find($subject_id);
        $subjects->subject_name = $request['subject_name'];
        $subjects->updated_user_id = $created_user_id;
        $subjects->academic_year_id = $academic_year_id;
        $old_values = Subject::find($subject_id);

        $data = array(
            'log_type' => 'Subject updated successfully!',
            'message' => 'updated',
            'new_value' => $request['subject_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $subjects->update();
        return redirect('view-subjects')->with(['message-success' => 'Subject ' . $request['subject_name'] . ' updated successfully.']);
    }

    public function make_inactive_subject($subject_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $subject_name = Subject::where('id', $subject_id)->value('subject_name');
            Subject::where('id', $subject_id)->update(['status' => 0]);
            return redirect('view-subjects')->with(['message-warning' => 'Subject ' . $subject_name . ' inactivated successfully.']);
        } else {
            return redirect('view-subjects');
        }
    }

    public function make_active_subject($subject_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $subject_name = Subject::where('id', $subject_id)->value('subject_name');
            Subject::where('id', $subject_id)->update(['status' => 1]);
            return redirect('view-subjects')->with(['message-info' => 'Subject ' . $subject_name . ' activated successfully.']);
        } else {
            return redirect('view-subjects');
        }
    }

    public function delete_subject($subject_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $subject_name = Subject::where('id', $subject_id)->value('subject_name');
            $old_values = Subject::where('id', $subject_id)->get();
            $data = array(
                'log_type' => 'subject deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Subject::where('id', $subject_id)->delete();
            return redirect('view-subjects')->with(['message-danger' => 'Subject ' . $subject_name . ' deleted successfully.']);
        } else {
            return redirect('view-subjects');
        }
    }

}
