<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Classes;
use App\Day;
use App\Section;
use App\Subject;
use App\Class_section;
use App\Class_subject;
use App\Http\Controllers\Controller;

class ClassSubjectController extends Controller {

    public function add_class_subject() {
        $add = Session::get('add');
        if ($add == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $days = Day::where('status', '1')->where('working_day', 1)->get();
            $class_sections = Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            $subjects = Subject::where('status', '1')->get();
            $timings = Subject::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            return view('class_subjects/add_class_subject', compact('days', 'class_sections', 'subjects', 'timings'));
        } else {
            return redirect('view-class-subjects');
        }
    }

    public function get_subjects(Request $request) {
        // $class_section_id = $request->input('class_section_id');
        // $day_id = $request->input('day_id');
        // $subjects = DB::select(DB::raw("SELECT id,subject_name FROM `subjects`where id NOT IN(SELECT subject_id from class_subjects WHERE class_section_id=$class_section_id AND day_id=$day_id)"));
        $subjects = DB::select(DB::raw("SELECT id,subject_name FROM subjects"));
        return($subjects);
    }

    public function get_timings(Request $request) {
        $class_section_id = $request->input('class_section_id');
        $academic_year_id = Session::get('academic_year_id');
        $day_id = $request->input('day_id');
        $timings = DB::select(DB::raw("SELECT time_id as id, class_start, class_end, title, duration, created_at FROM institute_timings where id NOT IN(SELECT institute_timing_id from class_subjects WHERE class_section_id=$class_section_id AND day_id=$day_id AND status=1 AND academic_year_id = $academic_year_id) AND academic_year_id = $academic_year_id"));
        return($timings);
    }

    public function do_add_class_subject(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'day_id' => 'required',
            'class_section_id' => 'required',
            'subject_id' => 'required',
            'institute_timing_id' => 'required',
        ]);
        $class_section_id = $request['class_section_id'];
        //$subject_id = $request['subject_id'];
        $time = $request['institute_timing_id'];
        $class_sectionss = Class_section::where('id', $class_section_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $class = Classes::where('id', $class_id)->value('class_name');
        $section = Section::where('id', $section_id)->value('section_name');
        $subject = Subject::where('id', $request['subject_id'])->value('subject_name');
        $all_day = $request['day_id'];
        if ($all_day == 8):
            $day_exist = DB::select(DB::raw("SELECT id, 'day_id' FROM class_subjects WHERE class_section_id=$class_section_id AND day_id != 7  AND institute_timing_id=$time AND academic_year_id = $academic_year_id "));
            if (COUNT($day_exist) >= 1) {
                return redirect('add-class-subject')->with(['message-info' => 'The class subject having different timings on different days.']);
            }
            $days = DB::select(DB::raw("SELECT id, day_title FROM days where status=1 AND working_day=1 AND id !=8 ORDER BY id"));

            foreach ($days as $day):
                $c_sub_ids = DB::select(DB::raw("SELECT max(id) as c_s_id FROM class_subjects"));
                if ($c_sub_ids != ''):
                    $c_sub_id = $c_sub_ids[0]->c_s_id;
                else:
                    $c_sub_id = 0;
                endif;
                $cs = $c_sub_id + 1;
                $class_subjects = new Class_subject();
                $class_subjects->day_id = $day->id;
                $class_subjects->class_section_id = $request['class_section_id'];
                $class_subjects->c_sub_id = $cs;
                $class_subjects->subject_id = $request['subject_id'];
                $class_subjects->institute_timing_id = $request['institute_timing_id'];
                $class_subjects->start_time = $request['start_time'];
                $class_subjects->end_time = $request['end_time'];
                $class_subjects->class_id = $class_id;
                $class_subjects->section_id = $section_id;
                $class_subjects->created_user_id = $created_user_id;
                $class_subjects->academic_year_id = $academic_year_id;
                $class_subjects->save();
            endforeach;
        else:
            $c_sub_ids = DB::select(DB::raw("SELECT max(id) as c_s_id FROM class_subjects"));
            if ($c_sub_ids != ''):
                $c_sub_id = $c_sub_ids[0]->c_s_id;
            else:
                $c_sub_id = 0;
            endif;
            $cs = $c_sub_id + 1;
            $class_subjects = new Class_subject();
            $class_subjects->c_sub_id = $cs;
            $class_subjects->day_id = $request['day_id'];
            $class_subjects->class_section_id = $request['class_section_id'];
            $class_subjects->subject_id = $request['subject_id'];
            $class_subjects->institute_timing_id = $request['institute_timing_id'];
            $class_subjects->start_time = $request['start_time'];
            $class_subjects->end_time = $request['end_time'];
            $class_subjects->class_id = $class_id;
            $class_subjects->section_id = $section_id;
            $class_subjects->created_user_id = $created_user_id;
            $class_subjects->academic_year_id = $academic_year_id;
            $class_subjects->save();
        endif;
        $data = array(
            'log_type' => ' class subject added successfully!',
            'message' => 'Added',
            'new_value' => $class . ' - ' . $section . ',' . Subject::where('id', $request['subject_id'])->value('subject_name') . ',' . Day::where('id', $request['day_id'])->value('day_title'),
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('view-class-subjects')->with(['message-success' => 'class ' . $class . '  ' . $section . '' . $subject . ' timings added successfully.']);
    }

    public function view_class_subjects() {
        $academic_year_id = Session::get('academic_year_id');
        $class_subjects = Class_subject::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('class_subjects/view_class_subjects', compact('class_subjects'));
    }

    public function edit_class_subject($class_subject_id) {
        $edit = Session::get('edit');
        if ($edit == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $class_subjects = Class_subject::where('id', $class_subject_id)->where('academic_year_id', $academic_year_id)->get();
            $class_section_id = $class_subjects[0]->class_section_id;
            $day_id = $class_subjects[0]->day_id;
            $subject_id = $class_subjects[0]->subject_id;
            $timings = DB::select(DB::raw("SELECT id, class_start, class_end, title, duration, created_at FROM institute_timings where id NOT IN(SELECT institute_timing_id from class_subjects WHERE class_section_id=$class_section_id AND day_id=$day_id AND subject_id !=$subject_id AND academic_year_id = $academic_year_id) AND academic_year_id = $academic_year_id"));
            return view('class_subjects/edit_class_subject', compact('class_subjects', 'timings'));
        } else {
            return redirect('view-class-subjects');
        }
    }

    public function do_edit_class_subject(Request $request, $class_subject_id) {
        $this->validate($request, [
            'day_id' => 'required',
            'class_section_id' => 'required',
            'subject_id' => 'required',
            'institute_timing_id' => 'required',
        ]);
        $timings = \App\Institute_timing::where('id', $request['institute_timing_id'])->get();
        $start = $timings[0]->class_start;
        $end = $timings[0]->class_end;
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request['class_section_id'];
        $class_sectionss = Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $class = Classes::where('id', $class_id)->value('class_name');
        $section = Section::where('id', $section_id)->value('section_name');
        $class_subjects = Class_subject::find($class_subject_id);
        $class_subjects->day_id = $request['day_id'];
        $class_subjects->class_section_id = $request['class_section_id'];
        $class_subjects->subject_id = $request['subject_id'];
        $class_subjects->institute_timing_id = $request['institute_timing_id'];
        $class_subjects->start_time = $start;
        $class_subjects->end_time = $end;
        $class_subjects->class_id = $class_id;
        $class_subjects->section_id = $section_id;
        $class_subjects->updated_user_id = $created_user_id;
        //$class_subjects->academic_year_id = $academic_year_id;
        $old_values = Class_subject::where('id', $class_subject_id)->where('academic_year_id', $academic_year_id)->get();
        $subject = Subject::where('id', $request['subject_id'])->value('subject_name');
        $data = array(
            'log_type' => ' class subject updated successfully!',
            'message' => 'updated',
            'new_value' => $class . ' - ' . $section . ',' . Subject::where('id', $request['subject_id'])->value('subject_name') . ',' . Day::where('id', $request['day_id'])->value('day_title'),
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_subjects->update();
        return redirect('view-class-subjects')->with(['message-success' => 'class ' . $class . '  ' . $section . ' ' . $subject . '  timings updated successfully.']);
    }

    public function make_inactive_class_subject($class_subject_id) {
        $edit = Session::get('edit');
        if ($edit == 1) {
            $class_subjects = Class_subject::where('id', $class_subject_id)->get();
            $class = $class_subjects[0]->classes->class_name;
            $subject = $class_subjects[0]->subjects->subject_name;
            if ((($class_subjects[0]->section_id) == '0') || (($class_subjects[0]->section_id) == '')) {
                $section = '';
            } else {
                $section = $class_subjects[0]->sections->section_name;
            }
            Class_subject::where('id', $class_subject_id)->update(['status' => 0]);
            return redirect('view-class-subjects')->with(['message-warning' => 'class ' . $class . '  ' . $section . ' ' . $subject . ' timing details inactivated successfully.']);
        } else {
            return redirect('view-class-subjects');
        }
    }

    public function make_active_class_subject($class_subject_id) {
        $edit = Session::get('edit');
        if ($edit == 1) {
            $class_subjects = Class_subject::where('id', $class_subject_id)->get();
            $class = $class_subjects[0]->classes->class_name;
            $subject = $class_subjects[0]->subjects->subject_name;
            if (($class_subjects[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_subjects[0]->sections->section_name;
            }
            Class_subject::where('id', $class_subject_id)->update(['status' => 1]);
            return redirect('view-class-subjects')->with(['message-info' => 'class ' . $class . '  ' . $section . ' ' . $subject . ' timing details activated successfully.']);
        } else {
            return redirect('view-class-subjects');
        }
    }

    public function delete_class_subject($class_subject_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $class_subjects = Class_subject::where('id', $class_subject_id)->get();
            $class = $class_subjects[0]->classes->class_name;
            $subject = $class_subjects[0]->subjects->subject_name;
            $start_time = $class_subjects[0]->start_time;
            $end_time = $class_subjects[0]->end_time;
            if (($class_subjects[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_subjects[0]->sections->section_name;
            }
            $data = array(
                'log_type' => 'class subject timings deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $class . '' . $section . ',' . $subject . ',' . $start_time . ',' . $end_time,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Class_subject::where('id', $class_subject_id)->delete();
            return redirect('view-class-subjects')->with(['message-danger' => 'class ' . $class . '  ' . $section . ' ' . $subject . ' timings deleted successfully.']);
        } else {
            return redirect('view-class-subjects');
        }
    }

}
