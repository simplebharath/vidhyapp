<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StudentAttendanceController extends Controller {

    public function add_student_attendance() {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_sections = \App\Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
            $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
            return view('students_attendance/get_students', compact('class_sections', 'attendance_type'));
        } else {
            return redirect('view-student-attendance');
        }
    }

    public function get_student_subjects(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request->input('class_section_id');
        $subjects = DB::select(DB::raw("SELECT su.id,su.subject_name FROM class_subjects cs LEFT JOIN subjects su ON cs.subject_id=su.id WHERE cs.class_section_id=$class_section_id AND cs.academic_year_id = $academic_year_id GROUP BY cs.subject_id"));
        return($subjects);
    }

    public function get_student_all(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_section_id = $request['class_section_id'];
            $subject_id = $request['subject_id'];
            //print_r($subject_id);exit;
            if ($class_section_id != ''):
                $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
                $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
                $class_name = \App\Class_section::where('id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
                $students = \App\Student::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->where('status', 1)->get();
            else:
                $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
                $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
                $class_name = '';
                $students = \App\Student::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            endif;
            $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
            if ($subject_id != "s"):
                if ($attendance == 2):
                    $subjects = \App\Subject::where('id', $subject_id)->get();
                    return view('students_attendance/add_student_attendance', compact('students', 'class_name', 'attendance_type', 'subjects', 'subject_id'));
                endif;
            endif;
            return view('students_attendance/add_student_attendance', compact('students', 'class_name', 'attendance_type', 'subject_id'));
        } else {
            return redirect('view-students-attendance');
        }
    }

    public function save_student_attendance(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        if ($request['attendance_status'] == ''):
            return redirect('add-student-attendance')->with(['message1-info' => 'No students in this class']);
        endif;
        $created_user_id = Session::get('user_login_id');
        $institute = \App\Institute_detail::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
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
            return redirect('add-student-attendance')->with(['message1-success' => 'Please select date before ' . $attendance_date]);
        endif;
        $day_name = date('l', strtotime($attendance_date));
        $working_day = \App\Day::where('day_title', $day_name)->value('working_day');
        if ($working_day == 0):
            return redirect('add-student-attendance')->with(['message1-success' => ' ' . $day_name . ' is not a working day.']);
        endif;
        $holidays = \App\Institute_holiday::where('holiday_date', $attendance_date)->get();
        if (COUNT($holidays) != 0):
            return redirect('add-student-attendance')->with(['message1-info' => 'Today is' . $holidays[0]->title . ' Holiday .']);
        endif;
        $subject_id = $request['subject_id'];
        $class_section_id = $request['class_section_id'];

        foreach ($class_section_id as $key => $value):
            $student_id = $key;
            $class_section = $value;
            $subjects = DB::select(DB::raw("SELECT su.id,su.subject_name FROM class_subjects cs LEFT JOIN subjects su ON cs.subject_id=su.id WHERE cs.class_section_id=$class_section AND cs.academic_year_id = $academic_year_id GROUP BY cs.subject_id"));
            if ($attendance_type_id == 2):
                $sub_id = $subject_id[$key];
                if ($sub_id != "s"):
                    $check = \App\Student_attendance::where('attendance_date', $formated_date)->where('class_section_id', $class_section)->where('subject_id', $sub_id)->get();
                else:

                    foreach ($subjects as $subject) {
                        $ss_id[] = $subject->id;
                    }
                    // print_r($ss_id);exit;
                    $check = \App\Student_attendance::where('attendance_date', $formated_date)->where('class_section_id', $class_section)->whereIn('subject_id', $ss_id)->get();
                endif;
            else:
                $check = \App\Student_attendance::where('attendance_date', $formated_date)->where('class_section_id', $class_section)->get();
            endif;
            if (COUNT($check) != 0):
                return redirect('add-student-attendance')->with(['message1-info' => 'Attendance  already taken on ' . $attendance_date . ' .']);
            endif;
        endforeach;

        $reason = $request['reason'];
        $attendance_status = $request['attendance_status'];
        if ($attendance_type_id == 1) {
            foreach ($attendance_status as $key => $value):
                $student_id = $key;
                $status = $value;
                $reasons = $reason[$key];
                $c_s_id = $class_section_id[$key];
                $student_attendance = new \App\Student_attendance();
                $student_attendance->attendance_status = $status;
                $student_attendance->reason = $reasons;
                $student_attendance->student_id = $student_id;
                $student_attendance->class_section_id = $c_s_id;
                $student_attendance->attendance_type_id = $attendance_type_id;
                $student_attendance->attendance_date = $formated_date;
                $student_attendance->created_user_id = $created_user_id;
                $student_attendance->academic_year_id = $academic_year_id;
                $student_attendance->save();
            endforeach;
        }
        if ($attendance_type_id == 2 && $subject_id[$key] != "s") {
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
        }

        if ($attendance_type_id == 2 && $subject_id[$key] == "s"):
            $subjects = DB::select(DB::raw("SELECT su.id,su.subject_name FROM class_subjects cs LEFT JOIN subjects su ON cs.subject_id=su.id WHERE cs.class_section_id=$class_section AND cs.academic_year_id = $academic_year_id GROUP BY cs.subject_id"));
            foreach ($subjects as $subject) {
                foreach ($attendance_status as $key => $value):
                    $student_id = $key;
                    $status = $value;
                    $reasons = $reason[$key];
                    $c_s_id = $class_section_id[$key];
                    $student_attendance = new \App\Student_attendance();
                    $student_attendance->attendance_status = $status;
                    $student_attendance->reason = $reasons;
                    $student_attendance->student_id = $student_id;
                    $student_attendance->class_section_id = $c_s_id;
                    $student_attendance->attendance_type_id = $attendance_type_id;
                    $student_attendance->attendance_date = $formated_date;
                    $student_attendance->created_user_id = $created_user_id;
                    $student_attendance->academic_year_id = $academic_year_id;
                    $student_attendance->subject_id = $subject->id;
                    $student_attendance->save();
                endforeach;
            }
        endif;

        $data = array(
            'log_type' => ' Student attendance added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('add-student-attendance')->with(['message-success' => 'Attendance  added successfully.']);
    }

    public function view_students_attendance() {
        $academic_year_id = Session::get('academic_year_id');
        $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
        $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
        $student_attendances = \App\Student_attendance::where('academic_year_id', $academic_year_id)->orderby('attendance_date', 'asc')->get();
        return view('students_attendance/view_students_attendance', compact('student_attendances', 'attendance_type'));
    }

    public function view_student_total_attendance($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $institute_details = \App\Institute_detail::where('status', 1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute_details[0]->attendance_type_id)->get();
        $students = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $parents = \App\Parent_detail::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        if ($institute_details[0]->attendance_type_id == 1):
            $student_attendances = DB::select(DB::raw("SELECT student_id,MONTHNAME(attendance_date) as month,YEAR(attendance_date) as year,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `student_attendances` WHERE student_id=$student_id AND student_attendances.academic_year_id=$academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        endif;
        if ($institute_details[0]->attendance_type_id == 2):
            $student_attendances = DB::select(DB::raw("SELECT subjects.subject_name,student_attendances.subject_id,student_id,MONTHNAME(attendance_date) as month,YEAR(attendance_date) as year,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `student_attendances` LEFT JOIN subjects ON subjects.id=student_attendances.subject_id WHERE student_id=$student_id AND student_attendances.academic_year_id=$academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date),subject_id"));
        endif;
        return view('students_attendance/view_student_total_attendace', compact('students', 'institute_details', 'student_attendances', 'parents', 'attendance_type'));
    }

    public function view_student_monthly_attendance($month, $student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $institute_details = \App\Institute_detail::where('status', 1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute_details[0]->attendance_type_id)->get();
        $students = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $parents = \App\Parent_detail::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        if ($institute_details[0]->attendance_type_id == 2):
            $student_attendances = DB::select(DB::raw("SELECT YEAR(student_attendances.attendance_date) as year,subjects.subject_name,student_attendances.subject_id, student_attendances.student_id,MONTHNAME(student_attendances.attendance_date) as month_name,DAYNAME(student_attendances.attendance_date) as day, DATE_FORMAT(student_attendances.attendance_date, '%d-%m-%Y') as date,student_attendances.attendance_status,student_attendances.reason FROM student_attendances LEFT JOIN subjects ON subjects.id=student_attendances.subject_id WHERE MONTHNAME(student_attendances.attendance_date)='$month' AND student_attendances.student_id=$student_id"));
        endif;
        if ($institute_details[0]->attendance_type_id == 1):
            $student_attendances = DB::select(DB::raw("SELECT YEAR(student_attendances.attendance_date) as year,student_attendances.student_id,MONTHNAME(student_attendances.attendance_date) as month_name,DAYNAME(student_attendances.attendance_date) as day, DATE_FORMAT(student_attendances.attendance_date, '%d-%m-%Y') as date,student_attendances.attendance_status,student_attendances.reason FROM student_attendances WHERE MONTHNAME(student_attendances.attendance_date)='$month' AND student_attendances.student_id=$student_id"));
        endif;
        $year = $student_attendances[0]->year;
        return view('students_attendance/view_student_monthly_attendace', compact('year', 'attendance_type', 'students', 'institute_details', 'student_attendances', 'parents', 'month'));
    }

    public function view_student_subject_attendance($month, $student_id, $subject_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $institute_details = \App\Institute_detail::where('status', 1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute_details[0]->attendance_type_id)->get();
        $students = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $parents = \App\Parent_detail::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $subject_name = \App\Subject::where('id', $subject_id)->value('subject_name');
        $student_attendances = DB::select(DB::raw("SELECT YEAR(student_attendances.attendance_date) as year,subjects.subject_name,student_attendances.subject_id, student_attendances.student_id,MONTHNAME(student_attendances.attendance_date) as month_name,DAYNAME(student_attendances.attendance_date) as day, DATE_FORMAT(student_attendances.attendance_date, '%d-%m-%Y') as date,student_attendances.attendance_status,student_attendances.reason FROM student_attendances LEFT JOIN subjects ON subjects.id=student_attendances.subject_id WHERE MONTHNAME(student_attendances.attendance_date)='$month' AND student_attendances.student_id=$student_id AND student_attendances.subject_id=$subject_id"));
        $year = $student_attendances[0]->year;
        return view('students_attendance/view_student_subject_attendace', compact('year', 'attendance_type', 'students', 'institute_details', 'student_attendances', 'parents', 'month', 'subject_name'));
    }

    public function edit_student_attendance() {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $class_sections = \App\Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            $attendance = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
            $attendance_type = \App\Attendance_type::where('id', $attendance)->get();
            return view('students_attendance/edit_get_students', compact('class_sections', 'attendance_type'));
        } else {
            return redirect('view-student-attendance');
        }
    }

}
