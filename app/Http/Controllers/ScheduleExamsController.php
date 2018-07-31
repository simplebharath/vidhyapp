<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Schedule_exam;
use App\Http\Controllers\Controller;
use \Input as Input;
use Carbon\Carbon;

class ScheduleExamsController extends Controller {

    public function view_schedule_exams() {
        $academic_year_id = Session::get('academic_year_id');
        $schedule_exams = Schedule_exam::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('schedule_exams/view_schedule_exams', compact('schedule_exams'));
    }

    public function add_schedule_exams($exam_id, $class_section_id) {
        $academic_year_id = Session::get('academic_year_id');
        $subjects = DB::select(DB::raw("SELECT su.id,su.subject_name FROM class_subjects cs LEFT JOIN subjects su ON cs.subject_id=su.id WHERE su.id NOT IN(SELECT subject_id FROM schedule_exams WHERE class_section_id =$class_section_id AND exam_id=$exam_id AND academic_year_id = $academic_year_id) AND cs.academic_year_id = $academic_year_id GROUP BY cs.subject_id"));
        $classes = \App\Class_section::where('id', $class_section_id)->get();
        $exams = \App\Exam::where('id', $exam_id)->get();
        return view('schedule_exams/add_schedule_exam', compact('subjects', 'exams', 'classes'));
    }

    public function do_add_schedule_exams(Request $request, $exam_id, $class_section_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'subject_id' => 'required',
            'exams_start_time' => 'required',
            'exams_end_time' => 'required|after:exams_start_time',
            'max_marks' => 'required',
            'pass_marks' => 'required',
            'exam_date' => 'required',
        ]);
        $hours = (new Carbon(date("H:i", strtotime($request['exams_end_time']))))->diff(new Carbon(date("H:i", strtotime($request['exams_start_time']))))->format('%h');
        $minutes = (new Carbon(date("H:i", strtotime($request['exams_end_time']))))->diff(new Carbon(date("H:i", strtotime($request['exams_start_time']))))->format('%I');
        $duration = $hours . ' hrs.' . $minutes . '  mins.';
        $class_sectionss = \App\Class_section::where('id', $class_section_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $schedule_exams = new Schedule_exam();
        $schedule_exams->subject_id = $request['subject_id'];
        $schedule_exams->exam_date = $request['exam_date'];
        $schedule_exams->exams_start_time = $request['exams_start_time'];
        $schedule_exams->exams_end_time = $request['exams_end_time'];
        $schedule_exams->class_id = $class_id;
        $schedule_exams->section_id = $section_id;
        $schedule_exams->exam_id = $exam_id;
        $schedule_exams->exam_duration = $duration;
        $schedule_exams->class_section_id = $class_section_id;
        $schedule_exams->max_marks = $request['max_marks'];
        $schedule_exams->pass_marks = $request['pass_marks'];
        $schedule_exams->exam_syllabus = $request['exam_syllabus'];
        $schedule_exams->created_user_id = $created_user_id;
        $schedule_exams->academic_year_id = $academic_year_id;
        $schedule_exams->save();
        $data = array(
            'log_type' => ' Sehedule Exams added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-schedule-exams')->with(['message-success' => 'Sehedule Exams  added successfully.']);
    }

    public function edit_schedule_exams($schedule_exams_id) {
        $academic_year_id = Session::get('academic_year_id');
        $schedule_exams = Schedule_exam::where('id', $schedule_exams_id)->where('academic_year_id', $academic_year_id)->get();
        return view('schedule_exams/edit_schedule_exam', compact('schedule_exams'));
    }

    public function do_edit_schedule_exams(Request $request, $schedule_exams_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $scheduled_exams = Schedule_exam::where('id', $schedule_exams_id)->where('academic_year_id', $academic_year_id)->get();
        $this->validate($request, [

            'exams_start_time' => 'required',
            'exams_end_time' => 'required|after:exams_start_time',
            'max_marks' => 'required',
            'pass_marks' => 'required',
            'exam_date' => 'required',
        ]);
        $hours = (new Carbon(date("H:i", strtotime($request['exams_end_time']))))->diff(new Carbon(date("H:i", strtotime($request['exams_start_time']))))->format('%h');
        $minutes = (new Carbon(date("H:i", strtotime($request['exams_end_time']))))->diff(new Carbon(date("H:i", strtotime($request['exams_start_time']))))->format('%I');
        $duration = $hours . ' hrs.  ' . $minutes . ' mins.';
        $class_sectionss = \App\Class_section::where('id', $scheduled_exams[0]->class_section_id)->where('academic_year_id', $academic_year_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $schedule_exams = Schedule_exam::find($schedule_exams_id);
        $schedule_exams->class_id = $class_id;
        $schedule_exams->section_id = $section_id;
        $schedule_exams->exam_date = $request['exam_date'];
        $schedule_exams->class_section_id = $scheduled_exams[0]->class_section_id;
        $schedule_exams->subject_id = $request['subject_id'];
        $schedule_exams->exam_duration = $duration;
        $schedule_exams->exams_start_time = $request['exams_start_time'];
        $schedule_exams->exams_end_time = $request['exams_end_time'];
        $schedule_exams->max_marks = $request['max_marks'];
        $schedule_exams->pass_marks = $request['pass_marks'];
        $schedule_exams->exam_syllabus = $request['exam_syllabus'];
        $schedule_exams->updated_user_id = $created_user_id;
        //$schedule_exams->academic_year_id = $academic_year_id;
        $old_values = Schedule_exam::find($schedule_exams_id);

        $data = array(
            'log_type' => 'Schedule exams updated successfully!',
            'message' => 'updated',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $schedule_exams->update();
        return redirect('view-schedule-exams')->with(['message-success' => 'Schedule exams  updated successfully.']);
    }

    public function delete_schedule_exams($schedule_exams_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Schedule_exam::where('id', $schedule_exams_id)->get();
        $data = array(
            'log_type' => 'Schedule_exams deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Schedule_exam::where('id', $schedule_exams_id)->delete();
        return redirect('view-schedule-exams')->with(['message-danger' => 'Schedule exams  deleted successfully.']);
    }

    public function make_inactive_schedule_exam($schedule_exams_id) {
        Schedule_exam::where('id', $schedule_exams_id)->update(['status' => 0]);
        return redirect('view-schedule-exams')->with(['message-warning' => 'Schedule exams  inactivated successfully.']);
    }

    public function make_active_schedule_exam($schedule_exams_id) {
        Schedule_exam::where('id', $schedule_exams_id)->update(['status' => 1]);
        return redirect('view-schedule-exams')->with(['message-info' => 'Schedule exams   activated successfully.']);
    }

}
