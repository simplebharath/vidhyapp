<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StudentRemarksController extends Controller {

    public function get_students_remarks() {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_sections = \App\Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            return view('students_remarks/get_students_remarks', compact('class_sections'));
        } else {
            return redirect('view-students-remarks');
        }
    }

    public function remark_class_subjects(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request['class_section_id'];
        $subjects = DB::select(DB::raw("SELECT subjects.id,subjects.subject_name FROM subjects WHERE subjects.id IN(SELECT subject_id FROM class_subjects WHERE class_section_id=$class_section_id AND academic_year_id = $academic_year_id GROUP BY subject_id)"));
        $students = \App\Student::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->where('status', 1)->get();
        $result = [ 'students' => $students,
            'subjects' => $subjects,
        ];
        return($result);
    }

    public function add_remarks_students(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_section_id = $request['class_section_id'];
            $subject_id = $request['subject_id'];
            $student_id = $request['student_id'];
            if ($subject_id != '' && $student_id != ''):
                $class_name = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $subject = \App\Subject::where('id', $subject_id)->get();
                $students = \App\Student::where('id', $student_id)->where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
            else:
                $class_name = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $subject = \App\Subject::where('id', $subject_id)->get();
                $students = \App\Student::where('status', 1)->where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
            endif;
            if ($subject_id == ''):
                $class_name = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $students = \App\Student::where('status', 1)->where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $subject = '';
            endif;
            if ($subject_id == '' && $student_id != ''):
                $class_name = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $students = \App\Student::where('id', $student_id)->where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $subject = '';
            endif;
            return view('students_remarks/add_student_remarks', compact('students', 'class_name', 'subject'));
        } else {
            return redirect('view-students-remarks');
        }
    }

    public function do_add_student_remarks(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        if ($request['remark_title'] == '') {
            return redirect('get-students-remarks')->with(['message-info' => 'No students in this Class.']);
        }
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'remark_title' => 'required',
        ]);

        $description = $request['remark_description'];
        $title = $request['remark_title'];
        foreach ($title as $key => $value):
            $student_id = $key;
            $remark_title = $value;
            $remark_description = $description[$key];
            $student_remarks = new \App\Student_remark();
            $student_remarks->student_id = $student_id;
            $student_remarks->remark_description = $remark_description;
            $student_remarks->remark_title = $remark_title;
            $student_remarks->created_user_id = $created_user_id;
            $student_remarks->academic_year_id = $academic_year_id;
            if ($request['subject_id'] != ''):
                $student_remarks->subject_id = $request['subject_id'];
            endif;
            $student_remarks->save();

        endforeach;
        $data = array(
            'log_type' => ' Student ReMarks added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-students-remarks')->with(['message-success' => 'Remarks  added successfully.']);
    }

    public function view_students_remarks() {
        $academic_year_id = Session::get('academic_year_id');
        $remarks = \App\Student_remark::where('academic_year_id', $academic_year_id)->get();
        return view('students_remarks/view_students_remarks', compact('remarks'));
    }

    public function edit_remarks($remark_id) {
        $academic_year_id = Session::get('academic_year_id');
        $remarks = \App\Student_remark::where('id', $remark_id)->where('academic_year_id', $academic_year_id)->get();
        $class_section_id = \App\Student::where('id', $remarks[0]->student_id)->where('academic_year_id', $academic_year_id)->value('class_section_id');
        if ($remarks[0]->subject_id > 0):
            $subject = \App\Subject::where('id', $remarks[0]->subject_id)->get();
        else:
            $subject = "";
        endif;
        $class_name = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();

        return view('students_remarks/edit_student_remarks', compact('remarks', 'subject', 'class_name'));
    }

    public function do_edit_remarks(Request $request, $remark_id) {
        $this->validate($request, [
            'remark_title' => 'required',
            'remark_description' => 'required',
        ]);
        $description = $request['remark_description'];
        $title = $request['remark_title'];
        $student_remarks = \App\Student_remark::find($remark_id);
        $student_remarks->remark_description = $description;
        $student_remarks->remark_title = $title;
        $student_remarks->update();
        return redirect('view-students-remarks')->with(['message-success' => 'Remark  updated successfully.']);
    }

    public function delete_remarks($remark_id) {
        \App\Student_remark::where('id', $remark_id)->delete();
        return redirect('view-students-remarks')->with(['message-danger' => 'Remark  deleted successfully.']);
    }

}
