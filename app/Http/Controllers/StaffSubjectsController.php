<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Subject;
use App\Class_section;
use App\Staff_subject;
use App\Http\Controllers\Controller;

class StaffSubjectsController extends Controller {

    public function add_staff_subject() {
        $academic_year_id = Session::get('academic_year_id');
        $staff_types = \App\Staff_type::where('status', '1')->get();
        $class_sections = Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
        $subjects = Subject::where('status', '1')->get();
        $staff = \App\Staff::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
        $timings = Subject::where('status', '1')->get();
        return view('staff_subjects/add_staff_subject', compact('staff_types', 'staff', 'class_sections', 'subjects', 'timings'));
    }

    public function get_staff(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $staff_department_id = $request->input('staff_department_id');
        $staff_type_id = $request->input('staff_type_id');
        $staff = \App\Staff::where('staff_type_id', $staff_type_id)->where('staff_department_id', $staff_department_id)->where('academic_year_id', $academic_year_id)->get();
        return($staff);
    }

    public function get_staff_subjects(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request->input('class_section_id');
        $subjects = DB::select(DB::raw("SELECT su.id,su.subject_name FROM class_subjects cs LEFT JOIN subjects su ON cs.subject_id=su.id WHERE su.id NOT IN(SELECT subject_id FROM staff_subjects WHERE class_section_id =$class_section_id AND status=1 AND academic_year_id = $academic_year_id) AND cs.class_section_id=$class_section_id AND cs.academic_year_id = $academic_year_id GROUP BY cs.subject_id"));
        return($subjects);
    }

    public function do_add_staff_subject(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_section_id' => 'required',
            'subject_id' => 'required',
            'staff_id' => 'required',
            'staff_type_id' => 'required',
            'staff_department_id' => 'required',
        ]);
        $class_section_id = $request['class_section_id'];
        $class_sectionss = Class_section::where('id', $class_section_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $staff_subjects = new Staff_subject();
        $staff_subjects->staff_type_id = $request['staff_type_id'];
        $staff_subjects->staff_department_id = $request['staff_department_id'];
        $staff_subjects->staff_id = $request['staff_id'];
        $staff_subjects->class_section_id = $request['class_section_id'];
        $staff_subjects->subject_id = $request['subject_id'];
        $staff_subjects->class_id = $class_id;
        $staff_subjects->section_id = $section_id;
        $staff_subjects->created_user_id = $created_user_id;
        $staff_subjects->academic_year_id = $academic_year_id;
        $staff_subjects->description = $request['description'];
        $staff_subjects->save();
        \App\Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->where('subject_id', $request['subject_id'])->update(['staff_id' => $request['staff_id']]);
        $data = array(
            'log_type' => ' staff subject added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-staff-subjects')->with(['message-success' => 'staff subject  added successfully.']);
    }

    public function view_staff_subjects() {
        $academic_year_id = Session::get('academic_year_id');
        $staff_subjects = Staff_subject::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('staff_subjects/view_staff_subjects', compact('staff_subjects'));
    }

    public function view_staff_timetable($staff_id) {
        $academic_year_id = Session::get('academic_year_id');
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
        }
        $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
        if ($classes != ''):
            $no_classes = $classes[0]->subjects;
        else:
            $no_classes = 0;
        endif;
        $institute_details = \App\Institute_detail::limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $staff_timetables = DB::select(DB::raw("SELECT d.day_title,su.subject_name,c.class_name,s.section_name,it.class_start,it.class_end,it.title,it.duration,cs.subject_id,cs.class_id,cs.section_id,cs.class_section_id,cs.institute_timing_id,cs.day_id,ss.staff_id FROM class_subjects cs LEFT JOIN staff_subjects ss 
ON ss.class_section_id=cs.class_section_id AND ss.subject_id=cs.subject_id 
LEFT JOIN days d ON d.id=cs.day_id LEFT JOIN institute_timings it ON it.id=cs.institute_timing_id LEFT JOIN subjects su ON su.id=ss.subject_id
LEFT JOIN classes c ON c.id=cs.class_id LEFT JOIN sections s ON s.id=cs.section_id WHERE ss.staff_id=$staff_id AND ss.academic_year_id=$academic_year_id "));

        return view('staff_timetable/view_staff_timetable', compact('staff_timetables', 'staffs', 'institute_details', 'no_classes'));
    }

    public function edit_staff_subject($staff_subject_id) {
        $academic_year_id = Session::get('academic_year_id');
        $staff_subjects = Staff_subject::where('id', $staff_subject_id)->get();
        $class_sec_id = $staff_subjects[0]->class_section_id;
        $subjects = DB::select(DB::raw("SELECT su.id,su.subject_name FROM subjects su LEFT JOIN class_subjects cs ON cs.subject_id=su.id WHERE su.id NOT IN(SELECT subject_id FROM staff_subjects WHERE  academic_year_id=$academic_year_id AND class_section_id =$class_sec_id AND id !=$staff_subject_id) GROUP BY cs.subject_id"));
        return view('staff_subjects/edit_staff_subject', compact('staff_subjects', 'subjects'));
    }

    public function do_edit_staff_subject(Request $request, $staff_subject_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_section_id' => 'required',
            'subject_id' => 'required',
            'staff_id' => 'required',
            'staff_type_id' => 'required',
            'staff_department_id' => 'required',
        ]);
        $class_sectionss = Class_section::where('id', $request['class_section_id'])->get();
        $class_id = $class_sectionss[0]->class_id;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
        } else {
            $section_id = '';
        }
        $staff_subjects = Staff_subject::find($staff_subject_id);
        $staff_subjects->staff_type_id = $request['staff_type_id'];
        $staff_subjects->staff_department_id = $request['staff_department_id'];
        $staff_subjects->staff_id = $request['staff_id'];
        $staff_subjects->class_section_id = $request['class_section_id'];
        $staff_subjects->subject_id = $request['subject_id'];
        $staff_subjects->class_id = $class_id;
        $staff_subjects->section_id = $section_id;
        $staff_subjects->updated_user_id = $created_user_id;
        // $staff_subjects->academic_year_id = $academic_year_id;
        $staff_subjects->description = $request['description'];
        $old_values = Staff_subject::where('id', $staff_subject_id)->get();
        if ($old_values[0]->subject_id != $request['subject_id']):
            \App\Class_subject::where('class_section_id', $request['class_section_id'])->where('subject_id', $request['subject_id'])->update(['staff_id' => $request['staff_id']]);
            \App\Class_subject::where('class_section_id', $request['class_section_id'])->where('subject_id', $old_values[0]->subject_id)->update(['staff_id' => 0]);
        else:
            \App\Class_subject::where('class_section_id', $request['class_section_id'])->where('subject_id', $request['subject_id'])->update(['staff_id' => $request['staff_id']]);
        endif;
        $data = array(
            'log_type' => ' staff subject updated successfully!',
            'message' => 'updated',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff_subjects->update();
        return redirect('view-staff-subjects')->with(['message-success' => 'staff subjects updated successfully! ']);
    }

    public function delete_staff_subjects($staff_subject_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $staff_subjects = Staff_subject::where('id', $staff_subject_id)->get();
        $data = array(
            'log_type' => 'staff subject  deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $staff_subjects,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Staff_subject::where('id', $staff_subject_id)->delete();
        return redirect('view-staff-subjects')->with(['message-danger' => 'staff subjects deleted successfully ']);
    }

    public function make_inactive_staff_subject($staff_subject_id) {
        Staff_subject::where('id', $staff_subject_id)->update(['status' => 0]);
        return redirect('view-staff-subjects')->with(['message-warning' => 'staff subjects Inactivated successfully ']);
    }

    public function make_active_staff_subject($staff_subject_id) {
        Staff_subject::where('id', $staff_subject_id)->update(['status' => 1]);
        return redirect('view-staff-subjects')->with(['message-info' => 'staff subjects activated successfully']);
    }

}
