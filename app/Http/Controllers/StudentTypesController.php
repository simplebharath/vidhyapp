<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Student_type;
use App\Http\Controllers\Controller;

class StudentTypesController extends Controller {

    public function add_student_type() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-student-types');
        }
        return view('student_type/add_student_type');
    }

    public function do_add_student_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:student_types',
        ]);
        $student_types = new Student_type();
        $student_types->title = $request['title'];
        $student_types->created_user_id = $created_user_id;
        $student_types->academic_year_id = $academic_year_id;
        $student_types->save();
        $data = array(
            'log_type' => ' student type added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-student-types')->with(['message-success' => 'student type ' . $request['title'] . ' added successfully.']);
    }

    public function view_student_types() {
        $student_types = Student_type::orderBy('created_at', 'desc')->paginate(20);
        return view('student_type/view_student_types', compact('student_types'));
    }

    public function edit_student_type($student_type_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $student_types = Student_type::where('id', $student_type_id)->get();
            return view('student_type/edit_student_type', compact('student_types'));
        } else {
            return redirect('view-student-types');
        }
    }

    public function do_edit_student_type(Request $request, $student_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:student_types,title,' . Student_type::where('id', $student_type_id)->value('id'),
        ]);
        $student_types = Student_type::find($student_type_id);
        $student_types->title = $request['title'];
        $student_types->updated_user_id = $created_user_id;
        $student_types->academic_year_id = $academic_year_id;
        $old_values = Student_type::find($student_type_id);

        $data = array(
            'log_type' => 'Student type updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $student_types->update();
        return redirect('view-student-types')->with(['message-success' => 'Student type ' . $request['title'] . ' updated successfully.']);
    }

    public function make_inactive_student_type($student_type_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $title = Student_type::where('id', $student_type_id)->value('title');
            Student_type::where('id', $student_type_id)->update(['status' => 0]);
            return redirect('view-student-types')->with(['message-warning' => 'Student type ' . $title . ' inactivated successfully.']);
        } else {
            return redirect('view-student-types');
        }
    }

    public function make_active_student_type($student_type_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {

            $title = Student_type::where('id', $student_type_id)->value('title');
            Student_type::where('id', $student_type_id)->update(['status' => 1]);
            return redirect('view-student-types')->with(['message-info' => 'Student type ' . $title . ' activated successfully.']);
        } else {
            return redirect('view-student-types');
        }
    }

    public function delete_student_type($student_type_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $title = Student_type::where('id', $student_type_id)->value('title');
            $old_values = Student_type::where('id', $student_type_id)->get();
            $data = array(
                'log_type' => 'student type deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Student_type::where('id', $student_type_id)->delete();
            return redirect('view-student-types')->with(['message-danger' => 'Student type ' . $title . ' deleted successfully.']);
        } else {
            return redirect('view-student-types');
        }
    }

}
