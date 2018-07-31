<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Session;
use App\Student;
use DB;
use App\Http\Controllers\Controller;

class PdfReportsController extends Controller {

    public function view_institute_classes_pdf($print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $classes = DB::select(DB::raw("SELECT class_sections.id,class_sections.class_id,class_sections.section_id, classes.class_name,sections.section_name,class_sections.id, COUNT(class_sections.id) as total_students FROM class_sections INNER JOIN students ON class_sections.id=students.class_section_id 
LEFT JOIN classes ON classes.id=class_sections.class_id
LEFT JOIN sections ON sections.id=class_sections.section_id WHERE class_sections.academic_year_id = $academic_year_id
GROUP BY students.class_section_id"));
        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_classes_pdf', compact('institute', 'years', 'print', 'classes'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_classes.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_classes.pdf');
        }
    }

    public function view_institute_students_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $admission_types = \App\Student_type::where('status', 1)->get();
        $students = Student::where('status', 1)->where('academic_year_id', $academic_year_id)->get();

        $class_id = 0;
        $classes_id = $request['class_section_id'];

        $admission_type_id = $request['student_type_id'];
        //print_r($admission_type_id);exit;
        if ($request['class_section_id'] != '' && $admission_type_id == ''):
            $classes = \App\Class_section::whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $students = Student::whereIn('class_section_id', $classes_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::whereIn('id', $classes_id)->where('status', 1)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $admission_types = \App\Student_type::where('status', 1)->get();
        endif;
        if ($classes_id != '' && $admission_type_id != ''):
            $students = Student:: whereIn('student_type_id', $admission_type_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::whereIn('id', $classes_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $admission_types = \App\Student_type::whereIn('id', $admission_type_id)->where('status', 1)->get();
        endif;
        if ($classes_id == '' && $admission_type_id != ''):
            $students = Student:: whereIn('student_type_id', $admission_type_id)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $admission_types = \App\Student_type::whereIn('id', $admission_type_id)->where('status', 1)->get();
        endif;
        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_students_pdf', compact('print', 'years', 'students', 'institute', 'admission_type_id', 'admission_types', 'classes_id', 'class_sections', 'class_id', 'classes'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_student.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_student.pdf');
        }
    }

    public function view_institute_transport_students_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $students = Student::where('student_type_id', 1)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $routes = \App\Vehicle_route::where('status', 1)->get();
        $stops = \App\Route_stop::where('status', 1)->get();

        $classes_id = $request['class_section_id'];
        $route_id = $request['route_id'];
        $stop_id = $request['stop_id'];

        if ($classes_id != '' && $route_id != '' && $stop_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->whereIn('id', $route_id)->get();
            $stops = \App\Route_stop::where('status', 1)->whereIn('id', $stop_id)->get();
            $students = Student:: whereIn('stop_id', $stop_id)->whereIn('route_id', $route_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id == '' && $route_id != '' && $stop_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->whereIn('id', $route_id)->get();
            $stops = \App\Route_stop::where('status', 1)->whereIn('id', $stop_id)->get();
            $students = Student:: whereIn('stop_id', $stop_id)->whereIn('route_id', $route_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id != '' && $route_id == '' && $stop_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->get();
            $stops = \App\Route_stop::where('status', 1)->whereIn('id', $stop_id)->get();
            $students = Student:: whereIn('stop_id', $stop_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id != '' && $route_id != '' && $stop_id == ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->whereIn('id', $route_id)->get();
            $stops = \App\Route_stop::where('status', 1)->get();
            $students = Student:: whereIn('route_id', $route_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id != '' && $route_id == '' && $stop_id == ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->get();
            $stops = \App\Route_stop::where('status', 1)->get();
            $students = Student:: whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id == '' && $route_id != '' && $stop_id == ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->whereIn('id', $route_id)->get();
            $stops = \App\Route_stop::where('status', 1)->get();
            $students = Student:: whereIn('route_id', $route_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id == '' && $route_id == '' && $stop_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $routes = \App\Vehicle_route::where('status', 1)->get();
            $stops = \App\Route_stop::where('status', 1)->whereIn('id', $stop_id)->get();
            $students = Student:: whereIn('stop_id', $stop_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_transport_students_pdf', compact('institute', 'years', 'print', 'students', 'routes', 'stops', 'class_sections', 'classes_id', 'route_id', 'stop_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_transport_student.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_transport_student.pdf');
        }
    }

    public function view_institute_timetable_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();

        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('day_id')->get();
        $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();

        $class_subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->where('status', '1')->orderBy('class_section_id', 'desc')->get();

        $class_id = $request['class_section_id'];
        $subject_id = $request['subject_id'];
        $day_id = $request['day_id'];

        if ($class_id != '' && $subject_id != '' && $day_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('day_id', $day_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('subject_id', $subject_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('day_id', $day_id)->whereIn('subject_id', $subject_id)->whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        endif;
        if ($class_id != '' && $subject_id != '' && $day_id == ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('subject_id', $subject_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();

        endif;
        if ($class_id != '' && $subject_id == '' && $day_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('day_id', $day_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('day_id', $day_id)->whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        endif;
        if ($class_id == '' && $subject_id != '' && $day_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('day_id', $day_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('subject_id', $subject_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->whereIn('day_id', $day_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        endif;
        if ($class_id != '' && $subject_id == '' && $day_id == ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        endif;
        if ($class_id == '' && $subject_id != '' && $day_id == ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('subject_id', $subject_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        endif;
        if ($class_id == '' && $subject_id == '' && $day_id != ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $days = \App\Class_subject::where('academic_year_id', $academic_year_id)->whereIn('day_id', $day_id)->groupBy('day_id')->get();
            $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_subjects = \App\Class_subject::whereIn('day_id', $day_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();
        endif;
        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_timetable_pdf', compact('institute', 'years', 'print', 'class_subjects', 'class_sections', 'day_id', 'subject_id', 'class_id', 'days', 'subjects'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_class_timetable.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_class_timetable.pdf');
        }
    }

    public function view_institute_fees_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $fees = \App\Fee::where('status', 1)->where('id', '!=', 1)->get();
        $class_fees = \App\Class_fee::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $class_id = $request['class_section_id'];
        $fee_id = $request['fee_id'];
        if ($request['class_section_id'] != '' && $request['fee_id'] == ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $fees = \App\Fee::where('status', 1)->where('id', '!=', 1)->get();
            $class_fees = \App\Class_fee::whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['class_section_id'] == '' && $request['fee_id'] != ''):
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $fees = \App\Fee::where('status', 1)->whereIn('id', $fee_id)->get();
            $class_fees = \App\Class_fee::whereIn('fee_id', $fee_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['class_section_id'] != '' && $request['fee_id'] != ''):
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $fees = \App\Fee::where('status', 1)->whereIn('id', $fee_id)->get();
            $class_fees = \App\Class_fee::whereIn('class_section_id', $class_id)->whereIn('fee_id', $fee_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_fees_pdf', compact('institute', 'years', 'print', 'fees', 'class_fees', 'class_sections', 'fee_id', 'class_id', 'classes'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_fees.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_fees.pdf');
        }
    }

    public function view_institute_transport_fees_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();

        $routes = \App\Vehicle_route::where('status', 1)->get();
        $stops = \App\Route_stop::where('status', 1)->get();
        $transport_fees = \App\Transport_fee::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $route_id = $request['route_id'];
        $stop_id = $request['stop_id'];

        if ($request['route_id'] != '' && $request['stop_id'] == ''):
            $routes = \App\Vehicle_route::where('status', 1)->whereIn('id', $route_id)->get();
            $stops = \App\Route_stop::where('status', 1)->get();
            $transport_fees = \App\Transport_fee::whereIn('route_id', $route_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['route_id'] == '' && $request['stop_id'] != ''):
            $routes = \App\Vehicle_route::where('status', 1)->get();
            $stops = \App\Route_stop::where('status', 1)->whereIn('id', $stop_id)->get();
            $transport_fees = \App\Transport_fee::whereIn('stop_id', $stop_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['route_id'] != '' && $request['stop_id'] != ''):
            $routes = \App\Vehicle_route::where('status', 1)->whereIn('id', $route_id)->get();
            $stops = \App\Route_stop::where('status', 1)->whereIn('id', $stop_id)->get();
            $transport_fees = \App\Transport_fee::whereIn('route_id', $route_id)->whereIn('stop_id', $stop_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;


        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_transport_fees_pdf', compact('institute', 'years', 'print', 'transport_fees', 'routes', 'stops', 'route_id', 'stop_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_transport_fees.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_transport_fees.pdf');
        }
    }

    public function view_institute_student_marks_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $marks = \App\Student_mark::where('academic_year_id', $academic_year_id)->get();
        $exams = \App\Exam::where('status', 1)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $subjects = \App\Subject::where('status', 1)->get();
        $exam_id = $request->exam_id;
        $classes_id = $request->class_section_id;
        $subject_id = $request->subject_id;
        if ($exam_id != '' && $classes_id != '' && $subject_id != ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->whereIn('id', $subject_id)->get();
            $marks = \App\Student_mark::whereIn('exam_id', $exam_id)->whereIn('subject_id', $subject_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id != '' && $classes_id != '' && $subject_id == ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->get();
            $marks = \App\Student_mark::whereIn('exam_id', $exam_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id != '' && $classes_id == '' && $subject_id != ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->whereIn('id', $subject_id)->get();
            $marks = \App\Student_mark::whereIn('exam_id', $exam_id)->whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id == '' && $classes_id != '' && $subject_id != ''):
            $exams = \App\Exam::where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->get();
            $marks = \App\Student_mark::whereIn('subject_id', $subject_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id != '' && $classes_id == '' && $subject_id == ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->whereIn('id', $subject_id)->get();
            $marks = \App\Student_mark::whereIn('exam_id', $exam_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id == '' && $classes_id != '' && $subject_id == ''):
            $exams = \App\Exam::where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->get();
            $marks = \App\Student_mark::whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id == '' && $classes_id == '' && $subject_id != ''):
            $exams = \App\Exam::where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $subjects = \App\Subject::where('status', 1)->whereIn('id', $subject_id)->get();
            $marks = \App\Student_mark::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->get();
        endif;

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_student_marks_pdf', compact('institute', 'years', 'print', 'subject_id', 'subjects', 'marks', 'exams', 'class_sections', 'classes_id', 'exam_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_exam_marks.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_exam_marks.pdf');
        }
    }

    public function view_institute_exam_timetable_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $exams = \App\Exam::where('status', 1)->get();
        $subjects = \App\Subject::where('status', 1)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $schedule_exams = \App\Schedule_exam::where('academic_year_id', $academic_year_id)->get();

        $exam_id = $request->exam_id;
        $classes_id = $request->class_section_id;
        $subject_id = $request->subject_id;
        if ($exam_id != '' && $classes_id != '' && $subject_id != ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $subjects = \App\Subject::whereIn('id', $subject_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('exam_id', $exam_id)->whereIn('subject_id', $subject_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id != '' && $classes_id != '' && $subject_id == ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $subjects = \App\Subject::where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('exam_id', $exam_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id != '' && $classes_id == '' && $subject_id != ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $subjects = \App\Subject::whereIn('id', $subject_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('exam_id', $exam_id)->whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id == '' && $classes_id != '' && $subject_id != ''):
            $exams = \App\Exam::where('status', 1)->get();
            $subjects = \App\Subject::whereIn('id', $subject_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('subject_id', $subject_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id != '' && $classes_id == '' && $subject_id == ''):
            $exams = \App\Exam::whereIn('id', $exam_id)->where('status', 1)->get();
            $subjects = \App\Subject::where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('exam_id', $exam_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id == '' && $classes_id != '' && $subject_id == ''):
            $exams = \App\Exam::where('status', 1)->get();
            $subjects = \App\Subject::where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($exam_id == '' && $classes_id == '' && $subject_id != ''):
            $exams = \App\Exam::where('status', 1)->get();
            $subjects = \App\Subject::whereIn('id', $subject_id)->where('status', 1)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $schedule_exams = \App\Schedule_exam::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->get();
        endif;

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_exam_timetable_pdf', compact('institute', 'years', 'print', 'subject_id', 'subjects', 'schedule_exams', 'exams', 'class_sections', 'classes_id', 'exam_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_exam_timetable.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_exam_timetable.pdf');
        }
    }

    public function view_institute_staff_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $staff_types = \App\Staff_type::where('status', 1)->get();
        $staff_departments = \App\Staff_department::where('status', 1)->get();
        $staffs = \App\Staff::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $staff_type_id = $request->staff_type_id;
        $department_id = $request->department_id;
        if ($department_id != '' && $staff_type_id != ''):
            $staff_types = \App\Staff_type::whereIn('id', $staff_type_id)->where('status', 1)->get();
            $staff_departments = \App\Staff_department::whereIn('id', $department_id)->where('status', 1)->get();
            $staffs = \App\Staff::whereIn('staff_type_id', $staff_type_id)->whereIn('staff_department_id', $department_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($department_id != '' && $staff_type_id == ''):
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::whereIn('id', $department_id)->where('status', 1)->get();
            $staffs = \App\Staff::whereIn('staff_department_id', $department_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($department_id == '' && $staff_type_id != ''):
            $staff_types = \App\Staff_type::whereIn('id', $staff_type_id)->where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $staffs = \App\Staff::whereIn('staff_type_id', $staff_type_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_staff_pdf', compact('institute', 'years', 'print', 'staffs', 'department_id', 'staff_types', 'staff_departments', 'staff_type_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_staff.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_staff.pdf');
        }
    }

    public function view_institute_staff_attendance_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $staff_types = \App\Staff_type::where('status', 1)->get();
        $staff_departments = \App\Staff_department::where('status', 1)->get();
        $staff_attendances = \App\Staff_attendance::where('academic_year_id', $academic_year_id)->get();
        $staff_type_id = $request->staff_type_id;
        $department_id = $request->department_id;
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        //print_r($from_date);exit;
        $from = date('Y-m-d', strtotime($request['from_date']));
        $to = date('Y-m-d', strtotime($request['to_date']));
        if ($staff_type_id == '' && $from_date != '' && $to_date != '' && $department_id == ''):
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $from_date == '' && $to_date == '' && $department_id == ''):
            $staff_types = \App\Staff_type::whereIn('id', $staff_type_id)->where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereIn('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $from_date == '' && $to_date == '' && $department_id != ''):
            $staff_types = \App\Staff_type::whereIn('id', $staff_type_id)->where('status', 1)->get();
            $staff_departments = \App\Staff_department::whereIn('id', $department_id)->where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereIn('id', $department_id)->whereIn('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $from_date != '' && $to_date != '' && $department_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $staff_types = \App\Staff_type::whereIn('id', $staff_type_id)->where('status', 1)->get();
            $staff_departments = \App\Staff_department::whereIn('id', $department_id)->where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereIn('staff_type_id', $staff_type_id)->whereIn('staff_department_id', $department_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id == '' && $from_date != '' && $to_date != '' && $department_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::whereIn('id', $department_id)->where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereIn('staff_department_id', $department_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id == '' && $from_date != '' && $to_date != '' && $department_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $from_date != '' && $to_date != '' && $department_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $staff_types = \App\Staff_type::whereIn('id', $staff_type_id)->where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereIn('staff_type_id', $staff_type_id)->whereBetween('attendance_date', [$from, $to])->get();
        endif;
        if ($staff_type_id == '' && $from_date == '' && $to_date == '' && $department_id != ''):
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::whereIn('id', $department_id)->where('status', 1)->get();
            $staff_attendances = \App\Staff_attendance::whereIn('staff_department_id', $department_id)->where('academic_year_id', $academic_year_id)->get();
        endif;

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_staff_attendance_pdf', compact('institute', 'years', 'print', 'staff_attendances', 'staffs', 'to_date', 'from_date', 'department_id', 'staff_types', 'staff_departments', 'staff_type_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_staff_attendance.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_staff_attendance.pdf');
        }
    }

    public function view_institute_staff_salary_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $staff_salaries = \App\Staff_salary::where('academic_year_id', $academic_year_id)->get();
        $staff_types = \App\Staff_type::where('status', 1)->get();
        $staff_departments = \App\Staff_department::where('status', 1)->get();
        $months = \App\Month::get();
        $staff_type_id = $request->staff_type_id;
        $department_id = $request->department_id;
        $month_id = $request->month_id;
        if ($staff_type_id != '' && $month_id != '' && $department_id != ''):
            $staff_types = \App\Staff_type::where('status', 1)->whereIn('id', $staff_type_id)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->whereIn('id', $department_id)->get();
            $months = \App\Month::whereIn('id', $month_id)->get();
            $staff_salaries = \App\Staff_salary::whereIn('staff_type_id', $staff_type_id)->whereIn('staff_department_id', $department_id)->whereIn('month_id', $month_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $month_id != '' && $department_id == ''):
            $staff_types = \App\Staff_type::where('status', 1)->whereIn('id', $staff_type_id)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $months = \App\Month::whereIn('id', $month_id)->get();
            $staff_salaries = \App\Staff_salary::whereIn('staff_type_id', $staff_type_id)->whereIn('month_id', $month_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $month_id == '' && $department_id != ''):
            $staff_types = \App\Staff_type::where('status', 1)->whereIn('id', $staff_type_id)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->whereIn('id', $department_id)->get();
            $months = \App\Month::get();
            $staff_salaries = \App\Staff_salary::whereIn('staff_type_id', $staff_type_id)->whereIn('staff_department_id', $department_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id == '' && $month_id != '' && $department_id != ''):
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->whereIn('id', $department_id)->get();
            $months = \App\Month::whereIn('id', $month_id)->get();
            $staff_salaries = \App\Staff_salary::whereIn('staff_department_id', $department_id)->whereIn('month_id', $month_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id != '' && $month_id == '' && $department_id == ''):
            $staff_types = \App\Staff_type::where('status', 1)->whereIn('id', $staff_type_id)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $months = \App\Month::get();
            $staff_salaries = \App\Staff_salary::whereIn('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id == '' && $month_id != '' && $department_id == ''):
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $months = \App\Month::whereIn('id', $month_id)->get();
            $staff_salaries = \App\Staff_salary::whereIn('month_id', $month_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($staff_type_id == '' && $month_id == '' && $department_id != ''):
            $staff_types = \App\Staff_type::where('status', 1)->get();
            $staff_departments = \App\Staff_department::where('status', 1)->get();
            $months = \App\Month::get();
            $staff_salaries = \App\Staff_salary::whereIn('staff_department_id', $department_id)->where('academic_year_id', $academic_year_id)->get();
        endif;

        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_staff_salary_pdf', compact('institute', 'years', 'print', 'staff_salaries', 'months', 'month_id', 'department_id', 'staff_types', 'staff_departments', 'staff_type_id'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_staff_salary.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_staff_salary.pdf');
        }
    }

    public function view_institute_student_attendance_pdf(Request $request, $print) {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $institute = \App\Institute_detail::limit(1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute[0]->attendance_type_id)->get();
        $class_id = $request['class_section_id'];
        $subject_id = $request['subject_id'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
        
        $attendance_type_id= $institute [0]->attendance_type_id;
        $from = date('Y-m-d', strtotime($request['from_date']));
        $to = date('Y-m-d', strtotime($request['to_date']));
        
        $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $student_attendances = \App\Student_attendance::where('academic_year_id', $academic_year_id)->get();
        
        if ($class_id != '' && $request['from_date'] != '' && $request['to_date'] != ''  && $subject_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('class_section_id', $class_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $request['from_date'] == '' && $request['to_date'] == ''  && $subject_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['from_date'] != '' && $request['to_date'] != '' && $class_id == ''  && $subject_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
       
        if ($class_id != '' && $request['from_date'] != '' && $request['to_date'] != '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id',$subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id',$subject_id)->whereIn('class_section_id', $class_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $request['from_date'] == '' && $request['to_date'] == '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id',$subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id',$subject_id)->whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['from_date'] != '' && $request['to_date'] != '' && $class_id == '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id',$subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id',$subject_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['from_date'] == '' && $request['to_date'] == '' && $class_id == '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id',$subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id',$subject_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        
        $date = date('Y', strtotime($years[0]->from_date)) . "_" . date('Y', strtotime($years[0]->to_date));
        $pdf = PDF::loadView('pdf_reports.view_institute_student_attendance_pdf', compact('attendance_type_id','subject_id','subjects','class_sections', 'from_date', 'to_date', 'class_id', 'attendance_type', 'student_attendances','years','print','institute'))
                ->setPaper('a4', 'portrait');
        if ($print == 1) {
            return $pdf->stream($date . '_student_attendance.pdf', array('Attachment' => false));
        } else {
            return $pdf->download($date . '_student_attendance.pdf');
        }
    }

}
