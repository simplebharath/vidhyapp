<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Session;
use App\Student;
use DB;
use App\Http\Controllers\Controller;

class PdfController extends Controller {

    public function class_schedule_pdf($class_section_id) {
        $academic_year_id = Session::get('academic_year_id');
        $classes = \App\Class_section::where('id', $class_section_id)->get();
        if ($classes[0]->section_id != 0):
            $section = \App\Section::where('id', $classes[0]->section_id)->value('section_name');
        else:
            $section = '';
        endif;
        $institutions = \App\Institute_detail::where('academic_year_id', $academic_year_id)->get();
        $class_subjects = \App\Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        $pdf = PDF::loadView('pdf_files.class_schedule_pdf', compact('classes', 'class_subjects', 'institutions'))->setPaper('a4', 'portrait');
        return $pdf->download($classes[0]->classes->class_name . ' ' . $section . ' - ' . 'Class Timetable.pdf');
    }

    public function student_summary_pdf($student_id) {
        $print = "";
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute[0]->attendance_type_id)->get();
        $student = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $educations = \App\Student_education::where('student_id', $student_id)->get();
        $student_documents = \App\Student_document::where('student_id', $student_id)->orderBy('created_at', 'desc')->get();
        if ($institute[0]->attendance_type_id == 1):
            $student_attendances = DB::select(DB::raw("SELECT student_id,MONTHNAME(attendance_date) as month,YEAR(attendance_date) as year,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `student_attendances` WHERE student_id=$student_id AND student_attendances.academic_year_id=$academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        endif;
        if ($institute[0]->attendance_type_id == 2):
            $student_attendances = DB::select(DB::raw("SELECT subjects.subject_name,student_attendances.subject_id,student_id,MONTHNAME(attendance_date) as month,YEAR(attendance_date) as year,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `student_attendances` LEFT JOIN subjects ON subjects.id=student_attendances.subject_id WHERE student_id=$student_id AND student_attendances.academic_year_id=$academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date),subject_id"));
        endif;

        $class_section_id = $student[0]->class_section_id;

        $exams = DB::select(DB::raw("SELECT exams.id as examid,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id"));
        if (COUNT($exams) != 0) {
            foreach ($exams as $exam) {
                $exam_id = $exam->examid;
                $marks[] = DB::select(DB::raw("SELECT  (SELECT grade_types.title FROM grade_settings LEFT JOIN grade_types ON grade_types.id=grade_settings.grade_type_id LEFT JOIN percentages ON percentages.id=grade_settings.percentage_id WHERE ((student_marks.marks_obtained/schedule_exams.max_marks)*100) BETWEEN coalesce(percentages.percentage_from,((student_marks.marks_obtained/schedule_exams.max_marks)*100)) AND coalesce(percentages.percentage_to,((student_marks.marks_obtained/schedule_exams.max_marks)*100))) as grade,
subjects.subject_name,exams.id as examid, exams.title,schedule_exams.exam_date,schedule_exams.max_marks,schedule_exams.pass_marks,student_marks.marks_obtained FROM `student_marks` LEFT JOIN schedule_exams ON student_marks.schedule_exam_id=schedule_exams.id
LEFT JOIN exams ON exams.id=student_marks.exam_id LEFT JOIN subjects ON subjects.id=student_marks.subject_id  WHERE student_marks.student_id=$student_id AND exams.id=$exam_id AND student_marks.academic_year_id=$academic_year_id AND student_marks.class_section_id=$class_section_id order BY student_marks.created_at DESC"));

                $totals[] = DB::select(DB::raw("SELECT  student_marks.exam_id,SUM(student_marks.marks_obtained) as total_marks_obtained, SUM(schedule_exams.max_marks) as total_marks,  ROUND((SUM(student_marks.marks_obtained)/SUM(schedule_exams.max_marks) * 100),2) as percentage,
(SELECT grade_types.title FROM grade_settings LEFT JOIN grade_types ON grade_types.id=grade_settings.grade_type_id LEFT JOIN percentages ON percentages.id=grade_settings.percentage_id WHERE
 
 ((( SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100) 
 BETWEEN coalesce(percentages.percentage_from,(((SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100)) 
 
 AND coalesce(percentages.percentage_to,(((SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100))  ) 
 as grade FROM student_marks LEFT JOIN schedule_exams ON schedule_exams.id=student_marks.schedule_exam_id
 WHERE student_marks.student_id=$student_id AND student_marks.exam_id=$exam_id AND student_marks.academic_year_id=$academic_year_id AND student_marks.class_section_id=$class_section_id "));
            }
        } else {
            $marks[] = "";
            $totals[] = "";
        }
        if ($student[0]->student_type_id == 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class_section_id AND cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        endif;
        if ($student[0]->student_type_id != 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id  LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class_section_id  AND f.id !=2 AND  cf.academic_year_id = $academic_year_id GROUP BY f.id"));

        endif;
        if ($student[0]->student_type_id == 1):
            $stop_id = $student[0]->stop_id;
            $transport_fees = DB::select(DB::raw("SELECT tr.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,tr.transport_fee ,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM transport_fees tr LEFT JOIN payment_records pr ON pr.fee_id=tr.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=tr.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=tr.fee_id LEFT JOIN fee_types ft ON ft.id=tr.fee_type_id  WHERE tr.stop_id=$stop_id AND tr.academic_year_id = $academic_year_id GROUP BY f.id"));

        else:
            $transport_fees = '';
        endif;
        if ($student[0]->class_sections->section_id != 0):
            $section = $student[0]->class_sections->sections->section_name;
        else:
            $section = '';
        endif;
        $payments = \App\Payment_record::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $routes = \App\Vehicle_driver::where('route_id', $student[0]->route_id)->get();
        $stops = \App\Route_stop::where('route_id', $student[0]->route_id)->get();
        $remarks = \App\Student_remark::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $class_subjects = \App\Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
        $assignments = \App\Assignment::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        //$s_exams = DB::select(DB::raw("SELECT exams.id,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id"));
        if (COUNT($exams) != 0) {
            foreach ($exams as $s_exam) {
                $examid = $s_exam->examid;
                $timings[] = DB::select(DB::raw("SELECT schedule_exams.*,exams.*,subjects.* FROM schedule_exams LEFT JOIN exams ON exams.id=schedule_exams.exam_id LEFT JOIN subjects ON subjects.id=schedule_exams.subject_id  WHERE  exams.id=$examid AND schedule_exams.academic_year_id=$academic_year_id AND schedule_exams.class_section_id=$class_section_id order BY schedule_exams.created_at DESC"));
            }
        } else {
            $timings[] = "";
        }

        $pdf = PDF::loadView('pdf_files.student_summary_pdf', compact('timings', 'assignments', 'class_subjects', 'print', 'remarks', 'stops', 'routes', 'payments', 'student_fees', 'transport_fees', 'student', 'institute', 'educations', 'student_documents', 'student_attendances', 'attendance_type', 'exams', 'marks', 'totals'))->setPaper('a4', 'portrait');
        return $pdf->download($student[0]->unique_id . '_student_summary.pdf');
    }

    public function student_summary_print($student_id) {

        $print = 1;
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute[0]->attendance_type_id)->get();
        $student = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $educations = \App\Student_education::where('student_id', $student_id)->get();
        $student_documents = \App\Student_document::where('student_id', $student_id)->orderBy('created_at', 'desc')->get();
        if ($institute[0]->attendance_type_id == 1):
            $student_attendances = DB::select(DB::raw("SELECT student_id,MONTHNAME(attendance_date) as month,YEAR(attendance_date) as year,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `student_attendances` WHERE student_id=$student_id AND academic_year_id=$academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        endif;
        if ($institute[0]->attendance_type_id == 2):
            $student_attendances = DB::select(DB::raw("SELECT subjects.subject_name,student_attendances.subject_id,student_id,MONTHNAME(attendance_date) as month,YEAR(attendance_date) as year,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `student_attendances` LEFT JOIN subjects ON subjects.id=student_attendances.subject_id WHERE student_id=$student_id AND student_attendances.academic_year_id=$academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date),subject_id"));
        endif;

        $class_section_id = $student[0]->class_section_id;

        $exams = DB::select(DB::raw("SELECT exams.id as examid,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id"));
        //print_r($exams);exit;
        foreach ($exams as $exam) {
            $exam_id = $exam->examid;
            $marks[] = DB::select(DB::raw("SELECT  (SELECT grade_types.title FROM grade_settings LEFT JOIN grade_types ON grade_types.id=grade_settings.grade_type_id LEFT JOIN percentages ON percentages.id=grade_settings.percentage_id WHERE ((student_marks.marks_obtained/schedule_exams.max_marks)*100) BETWEEN coalesce(percentages.percentage_from,((student_marks.marks_obtained/schedule_exams.max_marks)*100)) AND coalesce(percentages.percentage_to,((student_marks.marks_obtained/schedule_exams.max_marks)*100))) as grade,
subjects.subject_name,exams.id as examid, exams.title,schedule_exams.exam_date,schedule_exams.max_marks,schedule_exams.pass_marks,student_marks.marks_obtained FROM `student_marks` LEFT JOIN schedule_exams ON student_marks.schedule_exam_id=schedule_exams.id
LEFT JOIN exams ON exams.id=student_marks.exam_id LEFT JOIN subjects ON subjects.id=student_marks.subject_id  WHERE student_marks.student_id=$student_id AND exams.id=$exam_id AND student_marks.academic_year_id=$academic_year_id AND student_marks.class_section_id=$class_section_id order BY student_marks.created_at DESC"));

            $totals[] = DB::select(DB::raw("SELECT  student_marks.exam_id,SUM(student_marks.marks_obtained) as total_marks_obtained, SUM(schedule_exams.max_marks) as total_marks,  ROUND((SUM(student_marks.marks_obtained)/SUM(schedule_exams.max_marks) * 100),2) as percentage,
(SELECT grade_types.title FROM grade_settings LEFT JOIN grade_types ON grade_types.id=grade_settings.grade_type_id LEFT JOIN percentages ON percentages.id=grade_settings.percentage_id WHERE
 
 ((( SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100) 
 BETWEEN coalesce(percentages.percentage_from,(((SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100)) 
 
 AND coalesce(percentages.percentage_to,(((SUM(student_marks.marks_obtained))/(SUM(schedule_exams.max_marks)))*100))  ) 
 as grade FROM student_marks LEFT JOIN schedule_exams ON schedule_exams.id=student_marks.schedule_exam_id
 WHERE student_marks.student_id=$student_id AND student_marks.exam_id=$exam_id AND student_marks.academic_year_id=$academic_year_id AND student_marks.class_section_id=$class_section_id "));
        }
        if ($student[0]->student_type_id == 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class_section_id AND cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        endif;
        if ($student[0]->student_type_id != 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id  LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class_section_id  AND f.id !=2 AND  cf.academic_year_id = $academic_year_id GROUP BY f.id"));

        endif;
        if ($student[0]->student_type_id == 1):
            $stop_id = $student[0]->stop_id;
            $transport_fees = DB::select(DB::raw("SELECT tr.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,tr.transport_fee ,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM transport_fees tr LEFT JOIN payment_records pr ON pr.fee_id=tr.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=tr.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=tr.fee_id LEFT JOIN fee_types ft ON ft.id=tr.fee_type_id  WHERE tr.stop_id=$stop_id AND tr.academic_year_id = $academic_year_id GROUP BY f.id"));

        else:
            $transport_fees = '';
        endif;
        if ($student[0]->class_sections->section_id != 0):
            $section = $student[0]->class_sections->sections->section_name;
        else:
            $section = '';
        endif;
        $payments = \App\Payment_record::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $routes = \App\Vehicle_driver::where('route_id', $student[0]->route_id)->get();
        $stops = \App\Route_stop::where('route_id', $student[0]->route_id)->get();
        $remarks = \App\Student_remark::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();

        $class_subjects = \App\Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
        $assignments = \App\Assignment::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        //$s_exams = DB::select(DB::raw("SELECT exams.id,exams.title,class_exams.exams_start_date,class_exams.exams_end_date,class_exams.created_at FROM class_exams LEFT JOIN exams ON exams.id=class_exams.exam_id WHERE class_exams.class_section_id=$class_section_id AND class_exams.academic_year_id=$academic_year_id"));
        foreach ($exams as $s_exam) {
            $examid = $s_exam->examid;
            $timings[] = DB::select(DB::raw("SELECT schedule_exams.*,exams.*,subjects.* FROM schedule_exams LEFT JOIN exams ON exams.id=schedule_exams.exam_id LEFT JOIN subjects ON subjects.id=schedule_exams.subject_id  WHERE  exams.id=$examid AND schedule_exams.academic_year_id=$academic_year_id AND schedule_exams.class_section_id=$class_section_id order BY schedule_exams.created_at DESC"));
        }

        $pdf = PDF::loadView('pdf_files.student_summary_pdf', compact('timings', 'assignments', 'class_subjects', 'print', 'remarks', 'stops', 'routes', 'payments', 'student_fees', 'transport_fees', 'student', 'institute', 'educations', 'student_documents', 'student_attendances', 'attendance_type', 'exams', 'marks', 'totals'))->setPaper('a4', 'portrait');
        return $pdf->stream($student[0]->unique_id . '_student_summary.pdf', array('Attachment' => false));
    }

    public function payment_receipt_pdf($payment_id) {
        $print = "";
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $payments = \App\Payment_record::where('id', $payment_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $pdf = PDF::loadView('pdf_files.payment_receipt_pdf', compact('print', 'payments', 'institute'))->setPaper('a4', 'portrait');
        return $pdf->download($payments[0]->receipt_number . ' _student.pdf');
    }

    public function payment_receipt_print($payment_id) {
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $payments = \App\Payment_record::where('id', $payment_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $print = 1;
        $pdf = PDF::loadView('pdf_files.payment_receipt_pdf', compact('payments', 'institute', 'print'))->setPaper('a4', 'portrait');
        return $pdf->stream($payments[0]->receipt_number . ' _student.pdf', array('Attachment' => false));
    }

    public function payment_history_pdf($student_id) {
        $print = "";
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $payments = \App\Payment_record::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $pdf = PDF::loadView('pdf_files.payment_history_pdf', compact('print', 'payments', 'institute'))->setPaper('a4', 'portrait');
        return $pdf->download($payments[0]->students->unique_id . ' _payment_history.pdf');
    }

    public function payment_history_print($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $payments = \App\Payment_record::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        $print = 1;
        $pdf = PDF::loadView('pdf_files.payment_history_pdf', compact('payments', 'institute', 'print'))->setPaper('a4', 'portrait');
        return $pdf->stream($payments[0]->students->unique_id . ' _payment_history.pdf', array('Attachment' => false));
    }

    public function total_fees_pdf($student_id) {
        $print = "";
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
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
        $pdf = PDF::loadView('pdf_files.total_fees_pdf', compact('print', 'institute', 'student_fees', 'transport_fees', 'students'))->setPaper('a4', 'portrait');
        return $pdf->download($students[0]->unique_id . ' _fees.pdf');
    }

    public function total_fees_print($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
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
        $print = 1;
        $pdf = PDF::loadView('pdf_files.total_fees_pdf', compact('print', 'institute', 'student_fees', 'transport_fees', 'students'))->setPaper('a4', 'portrait');
        return $pdf->stream($students[0]->unique_id . ' _fees.pdf', array('Attachment' => false));
    }

    public function staff_summary_print($staff_id) {
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->where('academic_year_id', $academic_year_id)->get();
        $print = 1;
        $staff_experiences = \App\Staff_experience::where('staff_id', $staff_id)->orderBy('created_at', 'desc')->get();
        $staff_qualifications = \App\Staff_qualification::where('staff_id', $staff_id)->get();
        $staff_documents = \App\Staff_document::where('staff_id', $staff_id)->orderBy('created_at', 'desc')->get();
        $staff_attendances = DB::select(DB::raw("SELECT staff_id,YEAR(attendance_date) as year,MONTHNAME(attendance_date) as month,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `staff_attendances` WHERE staff_id=$staff_id AND academic_year_id = $academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        $staff_salaries = \App\Staff_salary::where('staff_id', $staff_id)->where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        $staff_timetables = DB::select(DB::raw("SELECT d.day_title,su.subject_name,c.class_name,s.section_name,it.class_start,it.class_end,it.title,it.duration,cs.subject_id,cs.class_id,cs.section_id,cs.class_section_id,cs.institute_timing_id,cs.day_id,ss.staff_id FROM class_subjects cs LEFT JOIN staff_subjects ss 
ON ss.class_section_id=cs.class_section_id AND ss.subject_id=cs.subject_id 
LEFT JOIN days d ON d.id=cs.day_id LEFT JOIN institute_timings it ON it.id=cs.institute_timing_id LEFT JOIN subjects su ON su.id=ss.subject_id
LEFT JOIN classes c ON c.id=cs.class_id LEFT JOIN sections s ON s.id=cs.section_id WHERE ss.staff_id=$staff_id AND ss.academic_year_id=$academic_year_id "));
        $pdf = PDF::loadView('pdf_files.staff_summary_pdf', compact('staff_timetables', 'staff_salaries', 'staff_attendances', 'staff_documents', 'staff_qualifications', 'staff_experiences', 'staffs', 'institute', 'print'))->setPaper('a4', 'portrait');
        return $pdf->stream($staffs[0]->staff_unique_id . ' _staff_summary.pdf', array('Attachment' => false));
    }

    public function staff_summary_pdf($staff_id) {
        $print = "";
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->where('academic_year_id', $academic_year_id)->get();
        $staff_experiences = \App\Staff_experience::where('staff_id', $staff_id)->orderBy('created_at', 'desc')->get();
        $staff_qualifications = \App\Staff_qualification::where('staff_id', $staff_id)->get();
        $staff_documents = \App\Staff_document::where('staff_id', $staff_id)->orderBy('created_at', 'desc')->get();
        $staff_attendances = DB::select(DB::raw("SELECT staff_id,YEAR(attendance_date) as year,MONTHNAME(attendance_date) as month,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `staff_attendances` WHERE staff_id=$staff_id AND academic_year_id = $academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        $staff_salaries = \App\Staff_salary::where('staff_id', $staff_id)->where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        $staff_timetables = DB::select(DB::raw("SELECT d.day_title,su.subject_name,c.class_name,s.section_name,it.class_start,it.class_end,it.title,it.duration,cs.subject_id,cs.class_id,cs.section_id,cs.class_section_id,cs.institute_timing_id,cs.day_id,ss.staff_id FROM class_subjects cs LEFT JOIN staff_subjects ss 
ON ss.class_section_id=cs.class_section_id AND ss.subject_id=cs.subject_id 
LEFT JOIN days d ON d.id=cs.day_id LEFT JOIN institute_timings it ON it.id=cs.institute_timing_id LEFT JOIN subjects su ON su.id=ss.subject_id
LEFT JOIN classes c ON c.id=cs.class_id LEFT JOIN sections s ON s.id=cs.section_id WHERE ss.staff_id=$staff_id AND ss.academic_year_id=$academic_year_id "));
        $pdf = PDF::loadView('pdf_files.staff_summary_pdf', compact('staff_timetables', 'staff_salaries', 'staff_attendances', 'staff_documents', 'staff_qualifications', 'staff_experiences', 'print', 'staffs', 'institute'))->setPaper('a4', 'portrait');
        return $pdf->download($staffs[0]->staff_unique_id . ' _staff_summary.pdf');
    }

    public function salary_pay_slip_print($pay_id) {
        $staff_salary = \App\Staff_salary::where('id', $pay_id)->get();
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_salary[0]->staff_id)->where('academic_year_id', $academic_year_id)->get();
        $print = 1;
        $pdf = PDF::loadView('pdf_files.staff_pay_slip', compact('staff_salary', 'print', 'staffs', 'institute'))->setPaper('a4', 'portrait');
        return $pdf->stream($staffs[0]->staff_unique_id . '_' . $staff_salary[0]->months->month . ' _salary_pay_slip.pdf', array('Attachment' => false));
    }

    public function salary_pay_slip_pdf($pay_id) {
        $print = "";
        $staff_salary = \App\Staff_salary::where('id', $pay_id)->get();
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_salary[0]->staff_id)->where('academic_year_id', $academic_year_id)->get();
        $pdf = PDF::loadView('pdf_files.staff_pay_slip', compact('staff_salary', 'print', 'staffs', 'institute'))->setPaper('a4', 'portrait');
        return $pdf->download($staffs[0]->staff_unique_id . '_' . $staff_salary[0]->months->month . ' _salary_pay_slip.pdf');
    }

    public function balance_sheet_total_pdf($print, $academic_year_id) {
        //$academic_year_id = Session::get('academic_year_id');
        //total balnace
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $expenses = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        $payments = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        //month wise report
        $days = '';
        $each_day = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $date1 = $years[0]->from_date;
        $date2 = $years[0]->to_date;
        $output = [];
        $time = strtotime($date1);
        $last = date('m-Y', strtotime($date2));
        do {
            $month = date('m-Y', $time);
            $month_years = date('F-Y', $time);
            $months = date('F', $time);
            $yearss = date('Y', $time);
            $total = date('t', $time);
            $output[] = [
                'month' => $month,
                'days' => $total,
                'months' => $months,
                'yearsss' => $months,
                'month_years' => $month_years,
            ];
            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        //print_r($output);exit;
        foreach ($output as $key => $innerArray) { {

                $monthss[] = $output[$key]['month'];
                $yearsss[] = $output[$key]['yearsss'];
                $month_yearss[] = $output[$key]['month_years'];
                $all = [
                    'as' => $monthss,
                    'bs' => $yearsss,
                    'cs' => $month_yearss,
                ];
            }
        }

        $exp = DB::select(DB::raw("SELECT   SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id"));
        $pay = DB::select(DB::raw("SELECT   SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id "));
        //print_r($exp[0]->total);exit;
        $paymentss = DB::select(DB::raw("SELECT DATE_FORMAT(payment_date,'%m-%Y') as month_year,MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        $expensess = DB::select(DB::raw("SELECT DATE_FORMAT(paid_on,'%m-%Y') as month_year,MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $total_balance = $pay[0]->total - $exp[0]->total;
        //payments :months
        $p_months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        //payments :days
        $p_days = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE  payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));

        $p_each_day = DB::select(DB::raw("SELECT payment_date,fees.fee_title,fees.id as feeid,YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records LEFT JOIN fees ON fees.id =payment_records.fee_id WHERE payment_records.academic_year_id =$academic_year_id  GROUP BY fee_id "));
        $a_payments = \App\Payment_record::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();

        $e_months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $e_days = DB::select(DB::raw("SELECT YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses  WHERE  expenses.academic_year_id =$academic_year_id  GROUP BY DAY(expenses.paid_on) ORDER BY paid_on DESC"));
        $e_each_day = DB::select(DB::raw("SELECT expenses.id,expenses.expense_type_id,expense_types.id, expense_types.title,YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses LEFT JOIN expense_types ON expense_types.id =expenses.expense_type_id WHERE expenses.academic_year_id =$academic_year_id   GROUP BY expense_type_id "));
        $e_expenses = \App\Expense::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_files.balance_sheet_total_pdf', compact('e_expenses', 'e_each_day', 'e_days', 'e_months', 'a_payments', 'p_each_day', 'p_days', 'p_months', 'institute', 'years', 'print', 'yearss', 'payments', 'expenses', 'total_balance', 'years', 'expensess', 'total_balance', 'monthss', 'output', 'months', 'paymentss', 'yearsss', 'month_yearss', 'days', 'each_day'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_balance_sheet.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_balance_sheet.pdf');
        }
    }

    public function balance_sheet_expenses_pdf($print, $academic_year_id) {
        //$academic_year_id = Session::get('academic_year_id');
        //total balnace
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $expenses = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        $payments = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        //month wise report
        $days = '';
        $each_day = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $date1 = $years[0]->from_date;
        $date2 = $years[0]->to_date;
        $output = [];
        $time = strtotime($date1);
        $last = date('m-Y', strtotime($date2));
        do {
            $month = date('m-Y', $time);
            $month_years = date('F-Y', $time);
            $months = date('F', $time);
            $yearss = date('Y', $time);
            $total = date('t', $time);
            $output[] = [
                'month' => $month,
                'days' => $total,
                'months' => $months,
                'yearsss' => $months,
                'month_years' => $month_years,
            ];
            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        //print_r($output);exit;
        foreach ($output as $key => $innerArray) { {

                $monthss[] = $output[$key]['month'];
                $yearsss[] = $output[$key]['yearsss'];
                $month_yearss[] = $output[$key]['month_years'];
                $all = [
                    'as' => $monthss,
                    'bs' => $yearsss,
                    'cs' => $month_yearss,
                ];
            }
        }

        $exp = DB::select(DB::raw("SELECT   SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id"));
        $pay = DB::select(DB::raw("SELECT   SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id "));
        //print_r($exp[0]->total);exit;
        $paymentss = DB::select(DB::raw("SELECT DATE_FORMAT(payment_date,'%m-%Y') as month_year,MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        $expensess = DB::select(DB::raw("SELECT DATE_FORMAT(paid_on,'%m-%Y') as month_year,MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $total_balance = $pay[0]->total - $exp[0]->total;
        //payments :months
        $p_months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        //payments :days
        $p_days = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE  payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));

        $p_each_day = DB::select(DB::raw("SELECT payment_date,fees.fee_title,fees.id as feeid,YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records LEFT JOIN fees ON fees.id =payment_records.fee_id WHERE payment_records.academic_year_id =$academic_year_id  GROUP BY fee_id "));
        $a_payments = \App\Payment_record::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();

        $e_months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $e_days = DB::select(DB::raw("SELECT YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses  WHERE  expenses.academic_year_id =$academic_year_id  GROUP BY DAY(expenses.paid_on) ORDER BY paid_on DESC"));
        $e_each_day = DB::select(DB::raw("SELECT expenses.id,expenses.expense_type_id,expense_types.id, expense_types.title,YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses LEFT JOIN expense_types ON expense_types.id =expenses.expense_type_id WHERE expenses.academic_year_id =$academic_year_id   GROUP BY expense_type_id "));
        $e_expenses = \App\Expense::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_files.balance_sheet_expenses_pdf', compact('e_expenses', 'e_each_day', 'e_days', 'e_months', 'a_payments', 'p_each_day', 'p_days', 'p_months', 'institute', 'years', 'print', 'yearss', 'payments', 'expenses', 'total_balance', 'years', 'expensess', 'total_balance', 'monthss', 'output', 'months', 'paymentss', 'yearsss', 'month_yearss', 'days', 'each_day'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_expenses_sheet.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_expenses_sheet.pdf');
        }
    }

    public function balance_sheet_payments_pdf($print, $academic_year_id) {
        //$academic_year_id = Session::get('academic_year_id');
        //total balnace
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $expenses = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        $payments = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        //month wise report
        $days = '';
        $each_day = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $date1 = $years[0]->from_date;
        $date2 = $years[0]->to_date;
        $output = [];
        $time = strtotime($date1);
        $last = date('m-Y', strtotime($date2));
        do {
            $month = date('m-Y', $time);
            $month_years = date('F-Y', $time);
            $months = date('F', $time);
            $yearss = date('Y', $time);
            $total = date('t', $time);
            $output[] = [
                'month' => $month,
                'days' => $total,
                'months' => $months,
                'yearsss' => $months,
                'month_years' => $month_years,
            ];
            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        //print_r($output);exit;
        foreach ($output as $key => $innerArray) { {

                $monthss[] = $output[$key]['month'];
                $yearsss[] = $output[$key]['yearsss'];
                $month_yearss[] = $output[$key]['month_years'];
                $all = [
                    'as' => $monthss,
                    'bs' => $yearsss,
                    'cs' => $month_yearss,
                ];
            }
        }

        $exp = DB::select(DB::raw("SELECT   SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id"));
        $pay = DB::select(DB::raw("SELECT   SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id "));
        //print_r($exp[0]->total);exit;
        $paymentss = DB::select(DB::raw("SELECT DATE_FORMAT(payment_date,'%m-%Y') as month_year,MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        $expensess = DB::select(DB::raw("SELECT DATE_FORMAT(paid_on,'%m-%Y') as month_year,MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $total_balance = $pay[0]->total - $exp[0]->total;
        //payments :months
        $p_months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        //payments :days
        $p_days = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE  payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));

        $p_each_day = DB::select(DB::raw("SELECT payment_date,fees.fee_title,fees.id as feeid,YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records LEFT JOIN fees ON fees.id =payment_records.fee_id WHERE payment_records.academic_year_id =$academic_year_id  GROUP BY fee_id "));
        $a_payments = \App\Payment_record::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();

        $e_months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $e_days = DB::select(DB::raw("SELECT YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses  WHERE  expenses.academic_year_id =$academic_year_id  GROUP BY DAY(expenses.paid_on) ORDER BY paid_on DESC"));
        $e_each_day = DB::select(DB::raw("SELECT expenses.id,expenses.expense_type_id,expense_types.id, expense_types.title,YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses LEFT JOIN expense_types ON expense_types.id =expenses.expense_type_id WHERE expenses.academic_year_id =$academic_year_id   GROUP BY expense_type_id "));
        $e_expenses = \App\Expense::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_files.balance_sheet_payments_pdf', compact('e_expenses', 'e_each_day', 'e_days', 'e_months', 'a_payments', 'p_each_day', 'p_days', 'p_months', 'institute', 'years', 'print', 'yearss', 'payments', 'expenses', 'total_balance', 'years', 'expensess', 'total_balance', 'monthss', 'output', 'months', 'paymentss', 'yearsss', 'month_yearss', 'days', 'each_day'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_payments.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_payments.pdf');
        }
    }

}
