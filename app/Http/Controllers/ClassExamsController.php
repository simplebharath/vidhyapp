<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Class_exam;
use App\Http\Controllers\Controller;

class ClassExamsController extends Controller {

    public function view_class_exams() {
        $academic_year_id = Session::get('academic_year_id');
        $class_exams = Class_exam::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('class_exams/view_class_exams', compact('class_exams'));
    }

    public function add_class_exam() {
        $academic_year_id = Session::get('academic_year_id');
        $class_exams = \App\Exam::where('status', '1')->get();
        $class_sections = \App\Class_section::where('academic_year_id', $academic_year_id)->where('status', 1)->get();
        $classes = \App\Classes::where('status', 1)->get();

        return view('class_exams/add_class_exam', compact('class_exams', 'class_sections', 'classes', 'sections'));
    }

    public function get_class_section(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_exam_id = $request->input('exam_id');
        $class_sections = DB::select(DB::raw("SELECT class_sections.id,classes.class_name,sections.section_name ,class_sections.section_id FROM `class_sections` LEFT JOIN classes ON classes.id=class_sections.class_id LEFT JOIN sections ON sections.id=class_sections.section_id where class_sections.id NOT IN(SELECT class_section_id from class_exams WHERE exam_id =$class_section_exam_id AND class_exams.academic_year_id = $academic_year_id) AND class_sections.academic_year_id = $academic_year_id AND class_sections.status=1"));
        return($class_sections);
    }

    public function do_add_class_exam(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'exam_id' => 'required',
            'class_section_id' => 'required',
            'exams_start_date' => 'required',
            'exams_end_date' => 'required|after:exams_start_date',
        ]);

        $classes = $request['class_section_id'];
        if (!empty($classes)):
            foreach ($classes as $class):
                $class_sectionss = \App\Class_section::where('id', $class)->get();
                $class_id = $class_sectionss[0]->class_id;
                if (($class_sectionss[0]->section_id) != 0) {
                    $section_id = $class_sectionss[0]->section_id;
                } else {
                    $section_id = '';
                }
                $class_exams = new Class_exam();
                $class_exams->exam_id = $request['exam_id'];
                $class_exams->class_section_id = $class;
                $class_exams->class_id = $class_id;
                $class_exams->section_id = $section_id;
                $class_exams->exams_start_date = $request['exams_start_date'];
                $class_exams->exams_end_date = $request['exams_end_date'];
                $class_exams->created_user_id = $created_user_id;
                $class_exams->academic_year_id = $academic_year_id;
                $class_exams->save();
            endforeach;
        endif;
        $data = array(
            'log_type' => ' class exam added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('view-class-exams')->with(['message-success' => 'class exam  added successfully.']);
    }

    public function edit_class_exam($class_section_exam_id) {
        $academic_year_id = Session::get('academic_year_id');
        $class_exams = Class_exam::where('id', $class_section_exam_id)->get();
        $class_sections = DB::select(DB::raw("SELECT class_sections.id,classes.class_name,sections.section_name ,class_sections.section_id FROM `class_sections` LEFT JOIN classes ON classes.id=class_sections.class_id LEFT JOIN sections ON sections.id=class_sections.section_id where class_sections.id NOT IN(SELECT class_section_id from class_exams WHERE exam_id =$class_section_exam_id AND academic_year_id = $academic_year_id) AND class_sections.academic_year_id = $academic_year_id AND class_sections.status=1"));
        return view('class_exams/edit_class_exam', compact('class_exams', 'class_sections', 'exams'));
    }

    public function do_edit_class_exam(Request $request, $class_section_exam_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'exam_id' => 'required',
            'class_section_id' => 'required',
            'exams_start_date' => 'required',
            'exams_end_date' => 'required|after:exams_start_date',
        ]);
        $class_sectionss = \App\Class_section::where('id', $request['class_section_id'])->where('academic_year_id', $academic_year_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $class_exams = Class_exam::find($class_section_exam_id);
        $class_exams->class_id = $class_id;
        $class_exams->section_id = $section_id;
        $class_exams->exam_id = $request['exam_id'];
        $class_exams->class_section_id = $request['class_section_id'];
        $class_exams->exams_start_date = $request['exams_start_date'];
        $class_exams->exams_end_date = $request['exams_end_date'];
        $class_exams->updated_user_id = $created_user_id;
        // $class_exams->academic_year_id = $academic_year_id;
        $old_values = Class_exam::find($class_section_exam_id);

        $data = array(
            'log_type' => 'class exams updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_exams->update();
        return redirect('view-class-exams')->with(['message-success' => 'class exams  updated successfully.']);
    }

    public function delete_class_exam($class_section_exam_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        //$class_exams = Class_exam::where('id', $class_section_exam_id)->get();
        $old_values = Class_exam::where('id', $class_section_exam_id)->get();
        $data = array(
            'log_type' => 'clase_exam deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Class_exam::where('id', $class_section_exam_id)->delete();
        return redirect('view-class-exams')->with(['message-danger' => 'clase_exam  deleted successfully.']);
    }

    public function make_inactive_class_exam($class_section_exam_id) {
        Class_exam::where('id', $class_section_exam_id)->update(['status' => 0]);
        return redirect('view-class-exams')->with(['message-warning' => 'class exam  inactivated successfully.']);
    }

    public function make_active_class_exam($class_section_exam_id) {
        Class_exam::where('id', $class_section_exam_id)->update(['status' => 1]);
        return redirect('view-class-exams')->with(['message-info' => 'class exam   activated successfully.']);
    }

}
