<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Class_section;
use App\Class_subject;
use Session;
use App\Http\Controllers\Controller;

class ClassScheduleController extends Controller {

    public function view_class_schedule() {
        $class_section_id = '';
        $class_name = '';
        $academic_year_id = Session::get('academic_year_id');
        $classes = Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->orderby('updated_at', 'DESC')->get();
        $class_subjects = Class_subject::where('status', '1')->where('academic_year_id', $academic_year_id)->orderBy('class_section_id', 'desc')->get();
        return view('class_schedule/view_class_schedule', compact('class_subjects', 'classes', 'class_section_id', 'class_name'));
    }

    public function class_schedule(Request $request) {
        $class_section_id = $request['class_section_id'];
        if ($class_section_id == 0) {
            return redirect('view-class-schedule');
        }
        $academic_year_id = Session::get('academic_year_id');
        $class_name = Class_section::where('id', $class_section_id)->get();
        $classes = Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->orderby('updated_at', 'DESC')->get();
        $class_subjects = Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        return view('class_schedule/view_class_schedule', compact('class_subjects', 'classes', 'class_section_id', 'class_name'));
    }

}
