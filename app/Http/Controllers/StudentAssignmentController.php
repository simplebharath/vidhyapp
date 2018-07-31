<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use \Input as Input;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class StudentAssignmentController extends Controller {

    public function get_students_assignments() {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_sections = \App\Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            return view('students_assignments/get_students_assignments', compact('class_sections'));
        } else {
            return redirect('view-students-assignments');
        }
    }

    public function get_assignment_students_list(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_section_id = $request['class_section_id'];
            $subject_id = $request['subject_id'];
            if ($class_section_id != ''):
                $class_name = \App\Class_section::where('id', $class_section_id)->get();
                $subject = \App\Subject::where('id', $subject_id)->get();
            else:
                $class_name = \App\Class_section::where('status', 1)->get();
                $subject = \App\Subject::where('id', $subject_id)->get();
            endif;
            return view('students_assignments/add_student_assignment', compact('class_name', 'subject'));
        } else {
            return redirect('view-students-assignments');
        }
    }

    public function do_add_assignment_class(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'assignment_title' => 'required',
        ]);
        $title = $request['assignment_title'];
        foreach ($title as $key => $value):
            $class_section_id = $key;
            $assignment_title = $value;
            $class_sections = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
            if ($class_sections[0]->section_id != 0):
                $section_id = $class_sections[0]->section_id;
            else: $section_id = '';
            endif;

            $student_assignments = new \App\Assignment();
            $student_assignments->class_section_id = $class_section_id;
            $student_assignments->assignment_description = $request['assignment_description'][$key];
            $student_assignments->assignment_title = $assignment_title;
            $student_assignments->last_date = $request['last_date'][$key];
            $student_assignments->class_id = $class_sections[0]->class_id;
            $student_assignments->section_id = $section_id;
            $student_assignments->created_user_id = $created_user_id;
            $student_assignments->academic_year_id = $academic_year_id;
            $student_assignments->subject_id = $request['subject_id'];

            if ($request->hasFile('assignment_file')) {
                $file = Input::file('assignment_file');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $name = $timestamp . '-' . $file[$key]->getClientOriginalName();
                $file[$key]->move(public_path() . '/uploads/assignments/', $name);
                $student_assignments->assignment_file = $name;
            }

            $student_assignments->save();

        endforeach;
        $data = array(
            'log_type' => ' Student Assignment added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-class-assignments')->with(['message-success' => 'Assignment  added successfully.']);
    }

    public function view_class_assignments() {
        $academic_year_id = Session::get('academic_year_id');
        $assignments = \App\Assignment::where('academic_year_id', $academic_year_id)->get();
        return view('students_assignments/view_students_assignment', compact('assignments'));
    }

    public function edit_assignment($assignment_id) {
        $assignments = \App\Assignment::where('id', $assignment_id)->get();
        return view('students_assignments/edit_student_assignment', compact('assignments'));
    }

    public function do_edit_assignment(Request $request, $assignment_id) {
        $this->validate($request, [
            'assignment_title' => 'required',
            'assignment_description' => 'required',
            'last_date' => 'required',
        ]);

        $student_assignments = \App\Assignment::find($assignment_id);
        $student_assignments->assignment_title = $request['assignment_title'];
        $student_assignments->assignment_description = $request['assignment_description'];
        $student_assignments->last_date = $request['last_date'];
        $old_image = \App\Assignment::where('id', $assignment_id)->value('assignment_file');
        if ($request->hasFile('assignment_file')) {
            $image = $old_image;
            if ($image != '') {
                $image_assignment = public_path() . '/uploads/assignments/' . $image;
                if (file_exists($image_assignment)) {
                    unlink($image_assignment);
                }
            }
            $file = Input::file('assignment_file');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/assignments/', $name);
            $student_assignments->assignment_file = $name;
        }
        $student_assignments->update();
        return redirect('view-class-assignments')->with(['message-success' => 'Assignment  updated successfully.']);
    }

    public function delete_assignment($assignment_id) {
        $old_image = \App\Assignment::where('id', $assignment_id)->value('assignment_file');
        if ($old_image != '') {
            $image_assignment = public_path() . '/uploads/assignments/' . $old_image;
            if (file_exists($image_assignment)) {
                unlink($image_assignment);
            }
        }
        \App\Assignment::where('id', $assignment_id)->delete();
        return redirect('view-class-assignments')->with(['message-danger' => 'Assignment  deleted successfully.']);
    }

}
