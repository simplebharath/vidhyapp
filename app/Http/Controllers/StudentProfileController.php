<?php

namespace App\Http\Controllers;

use \App\Student;
use DB;
use Session;
use App\Http\Controllers\Controller;

class StudentProfileController extends Controller {

//    protected $academic_year_id;
//
//    public function __construct() {
//       $this->$academic_year_id = Sessin::get('academic_year_id');
//       ->where('academic_year_id',$academic_year_id)
    // $academic_year_id= Session::get('academic_year_id');
//    }

    public function view_student_profile($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $students = Student::where('id', $student_id)->get();
        $parents = \App\Parent_detail::where('student_id', $student_id)->get();
        $educations = \App\Student_education::where('student_id', $students[0]->student_id)->get();
        return view('student_profile/student_profile', compact('students', 'institute_details', 'parents', 'educations'));
    }

    public function view_student_prof() {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        } else {
            return redirect('admin-login');
        }
        $students = Student::where('id', $student_id)->get();
        $parents = \App\Parent_detail::where('student_id', $student_id)->get();
        $educations = \App\Student_education::where('student_id', $students[0]->student_id)->get();
        return view('student_profile/student_profile', compact('students', 'institute_details', 'parents', 'educations'));
    }

    public function view_student_timetable($student_id, $class_section_id) {
        $academic_year_id = Session::get('academic_year_id');
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $students = Student::where('id', $student_id)->get();
        $class_subjects = \App\Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
        return view('student_profile/student_timetable', compact('students', 'institute_details', 'class_subjects'));
    }

    public function view_student_documents($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $students = Student::where('id', $student_id)->get();
        $student_documents = \App\Student_document::where('student_id', $student_id)->orderBy('created_at', 'desc')->get();
        return view('student_profile/student_documents', compact('students', 'institute_details', 'student_documents'));
    }

    public function view_student_fees($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $students = \App\Student::where('id', $student_id)->get();
        $class = $students[0]->class_section_id;
        if ($students[0]->student_type_id == 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class AND cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        endif;
        if ($students[0]->student_type_id != 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id  LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class  AND f.id !=2 AND  cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        //print_r($student_fees);exit;
        endif;
        if ($students[0]->student_type_id == 1):
            $stop_id = $students[0]->stop_id;
            $transport_fees = DB::select(DB::raw("SELECT tr.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,tr.transport_fee ,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM transport_fees tr LEFT JOIN payment_records pr ON pr.fee_id=tr.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=tr.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=tr.fee_id LEFT JOIN fee_types ft ON ft.id=tr.fee_type_id  WHERE tr.stop_id=$stop_id AND tr.academic_year_id = $academic_year_id GROUP BY f.id"));

        else:
            $transport_fees = '';
        endif;
        return view('student_profile/student_fees', compact('students', 'student_fees', 'transport_fees'));
    }

    public function view_student_payment_history($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('id', $student_id)->get();
        $payments = \App\Payment_record::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        return view('student_profile/student_payment_history', compact('students', 'payments'));
    }

    public function view_student_assignments($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('id', $student_id)->get();
        $assignments = \App\Assignment::where('class_section_id', $students[0]->class_section_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        return view('student_profile/student_assignments', compact('students', 'assignments', 'institute_details'));
    }

    public function view_student_remarks($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('id', $student_id)->get();
        $remarks = \App\Student_remark::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        return view('student_profile/student_remarks', compact('students', 'remarks', 'institute_details'));
    }

    public function view_student_exams($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('id', $student_id)->get();
        $class_section_id = $students[0]->class_section_id;
        $exams = DB::select(DB::raw("SELECT exams.id,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id ORDER BY class_exams.created_at DESC"));
        return view('student_profile/student_exams', compact('students', 'exams', 'institute_details'));
    }

    public function view_student_marks($exam_id, $student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('id', $student_id)->get();
        $class_section_id = $students[0]->class_section_id;
        $exams = DB::select(DB::raw("SELECT exams.id,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id AND class_exams.exam_id=$exam_id"));
        $marks = DB::select(DB::raw("SELECT  (SELECT grade_types.title FROM grade_settings LEFT JOIN grade_types ON grade_types.id=grade_settings.grade_type_id LEFT JOIN percentages ON percentages.id=grade_settings.percentage_id WHERE ((student_marks.marks_obtained/schedule_exams.max_marks)*100) BETWEEN coalesce(percentages.percentage_from,((student_marks.marks_obtained/schedule_exams.max_marks)*100)) AND coalesce(percentages.percentage_to,((student_marks.marks_obtained/schedule_exams.max_marks)*100))) as grade,
subjects.subject_name, exams.title,schedule_exams.exam_date,schedule_exams.max_marks,schedule_exams.pass_marks,student_marks.marks_obtained FROM `student_marks` LEFT JOIN schedule_exams ON student_marks.schedule_exam_id=schedule_exams.id
LEFT JOIN exams ON exams.id=student_marks.exam_id LEFT JOIN subjects ON subjects.id=student_marks.subject_id  WHERE student_marks.student_id=$student_id AND exams.id=$exam_id AND student_marks.academic_year_id=$academic_year_id AND student_marks.class_section_id=$class_section_id order BY student_marks.created_at DESC"));

        $totals = DB::select(DB::raw("SELECT  SUM(student_marks.marks_obtained) as total_marks_obtained, SUM(schedule_exams.max_marks) as total_marks,  ROUND((SUM(student_marks.marks_obtained)/SUM(schedule_exams.max_marks) * 100),2) as percentage,
(SELECT grade_types.title FROM grade_settings LEFT JOIN grade_types ON grade_types.id=grade_settings.grade_type_id LEFT JOIN percentages ON percentages.id=grade_settings.percentage_id WHERE
 
 ((( SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100) 
 BETWEEN coalesce(percentages.percentage_from,(((SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100)) 
 
 AND coalesce(percentages.percentage_to,(((SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100))  ) 
 as grade FROM student_marks LEFT JOIN schedule_exams ON schedule_exams.id=student_marks.schedule_exam_id
 WHERE student_marks.student_id=$student_id AND student_marks.exam_id=$exam_id AND student_marks.academic_year_id=$academic_year_id AND student_marks.class_section_id=$class_section_id "));
        return view('student_profile/student_marks', compact('students', 'totals', 'exams', 'marks', 'grades', 'institute_details'));
    }

    public function view_student_exam_timetable($exam_id, $student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('id', $student_id)->get();
        $class_section_id = $students[0]->class_section_id;
        $exams = DB::select(DB::raw("SELECT exams.id,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id AND class_exams.exam_id=$exam_id"));
        $timings = DB::select(DB::raw("SELECT schedule_exams.*,exams.*,subjects.* FROM schedule_exams LEFT JOIN exams ON exams.id=schedule_exams.exam_id LEFT JOIN subjects ON subjects.id=schedule_exams.subject_id  WHERE  exams.id=$exam_id AND schedule_exams.academic_year_id=$academic_year_id AND schedule_exams.class_section_id=$class_section_id order BY schedule_exams.created_at DESC"));

        return view('student_profile/student_exam_timetable', compact('students', 'exams', 'timings', 'institute_details'));
    }

    public function view_student_transport($route_id, $stop_id, $student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $routes = \App\Vehicle_driver::where('route_id', $route_id)->get();
        $students = Student::where('id', $student_id)->get();
        $stops = \App\Route_stop::where('route_id', $route_id)->get();
        return view('student_profile/student_transport', compact('students', 'routes', 'stops'));
    }

}
