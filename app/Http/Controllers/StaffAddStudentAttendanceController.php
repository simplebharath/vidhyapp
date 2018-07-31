<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StaffAddStudentAttendanceController extends Controller {

    public function add_student_attendance() {
        $add = Session::get('add');
        if ($add == 1) {
            $staff_id = Session::get('staff_id');
            $attendanc = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
            if ($attendanc == 1) {
                $class_sections = \App\Class_teacher::where('staff_id', $staff_id)->get();
            } else {
                $class_sections = \App\Staff_subject::where('staff_id', $staff_id)->groupBy('class_section_id')->get();
            }
            $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
            $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
            return view('staff_add_students_attendance/staff_get_students', compact('class_sections', 'attendance_type'));
        } else {
            return redirect('staff-view-student-attendance');
        }
    }

    public function staff_get_student_subjects(Request $request) {
        $staff_id = Session::get('staff_id');
        $class_section_id = $request['class_section_id'];
        $subject = DB::select(DB::raw("SELECT su.id,su.subject_name FROM staff_subjects cs LEFT JOIN subjects su ON cs.subject_id=su.id WHERE cs.class_section_id=$class_section_id AND cs.staff_id=$staff_id  GROUP BY cs.subject_id"));
        return($subject);
    }

    public function get_student_all(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $class_section_id = $request['class_section_id'];
            $subject_id = $request['subject_id'];
            if ($class_section_id != ''):
                $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
                $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
                $class_name = \App\Class_section::where('id', $class_section_id)->get();
                $students = \App\Student::where('class_section_id', $class_section_id)->where('status', 1)->get();
            else:
                $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
                $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
                $class_name = '';
                $students = \App\Student::where('status', 1)->get();
            endif;
            $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
            if ($attendance == 2):
                $subjects = \App\Subject::where('id', $subject_id)->get();
                return view('staff_add_students_attendance/staff_add_student_attendance', compact('students', 'class_name', 'attendance_type', 'subjects'));
            endif;
            return view('staff_add_students_attendance/staff_add_student_attendance', compact('students', 'class_name', 'attendance_type'));
        } else {
            return redirect('staff-view-students-attendance');
        }
    }

    public function save_student_attendance(Request $request) {
        if ($request['attendance_status'] == ''):
            return redirect('staff-add-student-attendance')->with(['message1-info' => 'No students in this class']);
        endif;
        $created_user_id = Session::get('user_login_id');
        $institute = \App\Institute_detail::where('status', '1')->get();
        $academic_year_id = Session::get('academic_year_id');
        $attendance_type_id = $institute[0]->attendance_type_id;
        $this->validate($request, [
            'attendance_status' => 'required',
            'attendance_date' => 'required',
        ]);

        $attendance_date = $request['attendance_date'];
        $formated_date = date("Y-m-d", strtotime($request['attendance_date']));
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        if ($formated_date > $current_date):
            return redirect('staff-add-student-attendance')->with(['message1-success' => 'Please select date before ' . $attendance_date]);
        endif;
        $day_name = date('l', strtotime($attendance_date));
        $working_day = \App\Day::where('day_title', $day_name)->value('working_day');
        if ($working_day == 0):
            return redirect('staff-add-student-attendance')->with(['message1-success' => ' ' . $day_name . ' is not a working day.']);
        endif;
        $holidays = \App\Institute_holiday::where('holiday_date', $attendance_date)->get();
        if (COUNT($holidays) != 0):
            return redirect('staff-add-student-attendance')->with(['message1-info' => 'Today is' . $holidays[0]->title . ' Holiday .']);
        endif;
        $subject_id = $request['subject_id'];
        $class_section_id = $request['class_section_id'];

        foreach ($class_section_id as $key => $value):
            $student_id = $key;
            $class_section = $value;
            if ($attendance_type_id == 2):
                $sub_id = $subject_id[$key];
                $check = \App\Student_attendance::where('attendance_date', $formated_date)->where('class_section_id', $class_section)->where('subject_id', $sub_id)->get();
            else:
                $check = \App\Student_attendance::where('attendance_date', $formated_date)->where('class_section_id', $class_section)->get();
            endif;
            if (COUNT($check) != 0):
                return redirect('staff-add-student-attendance')->with(['message1-info' => 'Attendance  already taken on ' . $attendance_date . ' .']);
            endif;
        endforeach;

        $reason = $request['reason'];
        $attendance_status = $request['attendance_status'];
        foreach ($attendance_status as $key => $value):
            $student_id = $key;
            $status = $value;
            $reasons = $reason[$key];
            $c_s_id = $class_section_id[$key];
            if ($attendance_type_id == 2):
                $s_id = $subject_id[$key];
            endif;
            $student_attendance = new \App\Student_attendance();
            $student_attendance->attendance_status = $status;
            $student_attendance->reason = $reasons;
            $student_attendance->student_id = $student_id;
            $student_attendance->class_section_id = $c_s_id;
            $student_attendance->attendance_type_id = $attendance_type_id;
            $student_attendance->attendance_date = $formated_date;
            $student_attendance->created_user_id = $created_user_id;
            $student_attendance->academic_year_id = $academic_year_id;
            if ($attendance_type_id == 2):
                $student_attendance->subject_id = $s_id;
            endif;

            $student_attendance->save();
        endforeach;
        $data = array(
            'log_type' => ' Student attendance added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('staff-add-student-attendance')->with(['message-success' => 'Attendance  added successfully.']);
    }

    public function view_students_attendance() {
        $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
        $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
        $student_attendances = \App\Student_attendance::where('created_user_id', Session::get('user_login_id'))->orderby('attendance_date', 'asc')->get();
        return view('staff_add_students_attendance/staff_view_students_attendance', compact('student_attendances', 'attendance_type'));
    }

}
