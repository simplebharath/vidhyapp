<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StudentPreviousEducationController extends Controller {

    public function add_student_education(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $uri = $request->path();
            $url_parts = explode('/', $uri);
            $student_id = $url_parts[1];
            $student = \App\Student::where('id', $student_id)->get();
            $student_educations = \App\Student_education::where('student_id', $student[0]->student_id)->get();
            if (COUNT($student) != 1):
                return redirect('add-student');
            endif;
            return view('student_educations/add_student_education', compact('student', 'student_educations'));
        } else {
            return redirect('view-students');
        }
    }

    public function edit_student_education($student_id, $student_education_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $student = \App\Student::where('id', $student_id)->get();
            $student_educations = \App\Student_education::where('id', $student_education_id)->get();
            return view('student_educations/edit_student_education', compact('student', 'student_educations'));
        } else {
            return redirect('view-students');
        }
    }

    public function do_add_student_education(Request $request, $student_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_from' => 'required',
            'institute_name' => 'required',
            'class_to' => 'required',
            'to_year' => 'required',
            'from_year' => 'required',
        ]);
        $id = \App\Student::where('id', $student_id)->value('student_id');
        $student_educations = new \App\Student_education();
        $student_educations->class_from = $request['class_from'];
        $student_educations->institute_name = $request['institute_name'];
        $student_educations->class_to = $request['class_to'];
        $student_educations->from_year = $request['from_year'];
        $student_educations->to_year = $request['to_year'];
        $student_educations->education_description = $request['education_description'];
        $student_educations->student_id = $id;
        $student_educations->created_user_id = $created_user_id;
        $student_educations->academic_year_id = $academic_year_id;
        $student_educations->save();
        $data = array(
            'log_type' => ' Student added successfully!',
            'message' => 'Added',
            'new_value' => $request['institute_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('add-student-education/' . $student_id)->with(['message-success' => 'Education in ' . $request['institute_name'] . ' added successfully.']);
    }

    public function do_edit_student_education(Request $request, $student_id, $student_education_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_from' => 'required',
            'institute_name' => 'required',
            'class_to' => 'required',
            'to_year' => 'required',
            'from_year' => 'required',
        ]);
        $student_educations = \App\Student_education::find($student_education_id);
        $student_educations->class_from = $request['class_from'];
        $student_educations->institute_name = $request['institute_name'];
        $student_educations->education_description = $request['education_description'];
        $student_educations->class_to = $request['class_to'];
        $student_educations->from_year = $request['from_year'];
        $student_educations->to_year = $request['to_year'];
        $student_educations->student_id = $student_id;
        $student_educations->updated_user_id = $created_user_id;
        // $student_educations->academic_year_id = $academic_year_id;

        $data = array(
            'log_type' => 'Student education  updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['institute_name'],
            'old_value' => \App\Student_education::where('id', $student_education_id)->get(),
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $student_educations->update();
        return redirect('add-student-education/' . $student_id)->with(['message-success' => 'Student education in ' . $request['institute_name'] . ' updated successfully.']);
    }

    public function delete_student_education($student_id, $student_education_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = \App\Student_education::where('id', $student_education_id)->get();
        $data = array(
            'log_type' => 'Student education deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $qulification = \App\Student_education::where('id', $student_education_id)->value('institute_name');
        \App\Student_education::where('id', $student_education_id)->delete();
        return redirect('add-student-education/' . $student_id)->with(['message-danger' => 'Student education ' . $qulification . ' deleted successfully.']);
    }

}
