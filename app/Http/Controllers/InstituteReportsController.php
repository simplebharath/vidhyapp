<?php

namespace App\Http\Controllers;

use \App\Student;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteReportsController extends Controller {

    public function view_institute_students(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $admission_types = \App\Student_type::where('status', 1)->get();
        $class_id = 0;
        $classes_id = $request['class_section_id'];
        $admission_type_id = $request['student_type_id'];
        if ($request['class_section_id'] != '' && $admission_type_id == ''):
            $classes = \App\Class_section::whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $students = Student::whereIn('class_section_id', $classes_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id != '' && $admission_type_id != ''):
            $students = Student:: whereIn('student_type_id', $admission_type_id)->whereIn('class_section_id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id == '' && $admission_type_id != ''):
            $students = Student:: whereIn('student_type_id', $admission_type_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        return view('institute_reports/view_institute_students', compact('students', 'admission_type_id', 'admission_types', 'classes_id', 'class_sections', 'class_id', 'classes'));
    }

    public function view_institute_transport_students(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_transport_students', compact('students', 'routes', 'stops', 'class_sections', 'classes_id', 'route_id', 'stop_id'));
    }

    public function view_institute_class_students(Request $request, $clas_id) {
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $admission_types = \App\Student_type::where('status', 1)->get();
        $admission_type_id = $request['student_type_id'];
        $class_id = 0;
        $classes_id = [$clas_id, 0];
        if ($classes_id != ''):
            $classes = \App\Class_section::whereIn('id', $classes_id)->where('academic_year_id', $academic_year_id)->get();
            $students = Student::whereIn('class_section_id', $classes_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        return view('institute_reports/view_institute_students', compact('students', 'admission_type_id', 'admission_types', 'classes_id', 'class_sections', 'class_id', 'classes'));
    }

    public function view_institute_timetable(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_timetable', compact('class_subjects', 'class_sections', 'day_id', 'subject_id', 'class_id', 'days', 'subjects'));
    }

    public function view_institute_classes() {
        $academic_year_id = Session::get('academic_year_id');
        $class = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        foreach ($class as $c) {
            $id = $c->id;
            $classes[] = DB::select(DB::raw("SELECT class_sections.id,class_sections.class_id,class_sections.section_id, classes.class_name,sections.section_name,class_sections.id, COUNT(class_sections.id) as total_students FROM class_sections INNER JOIN students ON class_sections.id=students.class_section_id 
LEFT JOIN classes ON classes.id=class_sections.class_id
LEFT JOIN sections ON sections.id=class_sections.section_id WHERE students.status=1 AND class_sections.academic_year_id = $academic_year_id AND students.academic_year_id = $academic_year_id AND
class_sections.id =$id"));
        }
        return view('institute_reports/view_institute_classes', compact('classes', 'class'));
    }

    public function view_institute_fees(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_fees', compact('fees', 'class_fees', 'class_sections', 'fee_id', 'class_id', 'classes'));
    }

    public function view_institute_transport_fees(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_transport_fees', compact('transport_fees', 'routes', 'stops', 'route_id', 'stop_id'));
    }

    public function view_institute_students_attendance(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $attendance_type = \App\Attendance_type::where('id', $institute[0]->attendance_type_id)->get();

        $class_id = $request['class_section_id'];
        $subject_id = $request['subject_id'];
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];

        $attendance_type_id = $institute [0]->attendance_type_id;
        $from = date('Y-m-d', strtotime($request['from_date']));
        $to = date('Y-m-d', strtotime($request['to_date']));

        $subjects = \App\Class_subject::where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $student_attendances = \App\Student_attendance::where('academic_year_id', $academic_year_id)->get();

        if ($class_id != '' && $request['from_date'] != '' && $request['to_date'] != '' && $subject_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('class_section_id', $class_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $request['from_date'] == '' && $request['to_date'] == '' && $subject_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['from_date'] != '' && $request['to_date'] != '' && $class_id == '' && $subject_id == ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;

        if ($class_id != '' && $request['from_date'] != '' && $request['to_date'] != '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id', $subject_id)->whereIn('class_section_id', $class_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $request['from_date'] == '' && $request['to_date'] == '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->whereIn('id', $class_id)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id', $subject_id)->whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['from_date'] != '' && $request['to_date'] != '' && $class_id == '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id', $subject_id)->whereBetween('attendance_date', [$from, $to])->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($request['from_date'] == '' && $request['to_date'] == '' && $class_id == '' && $subject_id != ''):
            $from_date = $request['from_date'];
            $to_date = $request['to_date'];
            $subjects = \App\Class_subject::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->groupBy('subject_id')->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $student_attendances = \App\Student_attendance::whereIn('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->get();
        endif;

        return view('institute_reports/view_institute_student_attendance', compact('subject_id', 'subjects', 'class_sections', 'from_date', 'to_date', 'class_id', 'attendance_type', 'student_attendances'));
    }

    public function view_institute_staff(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_staff', compact('staffs', 'department_id', 'staff_types', 'staff_departments', 'staff_type_id'));
    }

    public function view_institute_staff_attendance(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $staff_types = \App\Staff_type::where('status', 1)->get();
        $staff_departments = \App\Staff_department::where('status', 1)->get();
        $staff_attendances = \App\Staff_attendance::where('academic_year_id', $academic_year_id)->get();
        $staff_type_id = $request->staff_type_id;
        $department_id = $request->department_id;
        $from_date = $request['from_date'];
        $to_date = $request['to_date'];
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
            $staff_attendances = \App\Staff_attendance::whereIn('staff_department_id', $department_id)->whereIn('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->get();
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

        return view('institute_reports/view_institute_staff_attendance', compact('staff_attendances', 'staffs', 'to_date', 'from_date', 'department_id', 'staff_types', 'staff_departments', 'staff_type_id'));
    }

    public function view_institute_staff_salary(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_staff_salary', compact('staff_salaries', 'months', 'month_id', 'department_id', 'staff_types', 'staff_departments', 'staff_type_id'));
    }

    public function view_institute_students_marks(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_students_marks', compact('subject_id', 'subjects', 'marks', 'exams', 'class_sections', 'classes_id', 'exam_id'));
    }

    public function view_institute_student_payments(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $fees = \App\Fee::where('status', 1)->get();
        $class_sections = \App\Class_section::where('status', 1)->get();
        $payments = \App\Payment_record::where('academic_year_id', $academic_year_id)->get();
        $fee_id = $request->fee_id;
        $class_id = $request->class_section_id;
        $date_input = $request['date'];
        $date = date("Y-m-d", strtotime($date_input));
        if ($class_id != '' && $fee_id != '' && $date != ''):
            $payments = \App\Payment_record::whereIn('fee_id', $fee_id)->whereIn('class_section_id', $class_id)->where('payment_date', $date)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $fee_id != '' && $date == ''):
            $payments = \App\Payment_record::whereIn('fee_id', $fee_id)->whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $fee_id == '' && $date != ''):
            $payments = \App\Payment_record::whereIn('class_section_id', $class_id)->where('payment_date', $date)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id == '' && $fee_id != '' && $date != ''):
            $payments = \App\Payment_record::whereIn('fee_id', $fee_id)->where('payment_date', $date)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id != '' && $fee_id == '' && $date == ''):
            $payments = \App\Payment_record::whereIn('class_section_id', $class_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id == '' && $fee_id != '' && $date == ''):
            $payments = \App\Payment_record::whereIn('fee_id', $fee_id)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_id == '' && $fee_id == '' && $date != ''):
            $payments = \App\Payment_record::where('payment_date', $date)->where('academic_year_id', $academic_year_id)->get();
        endif;
        return view('institute_reports/view_institute_fee_payments', compact('payments', 'date', 'fee_id', 'class_id', 'class_sections', 'fees'));
    }

    public function view_institute_exam_timetable(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
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
        return view('institute_reports/view_institute_exam_timetable', compact('subject_id', 'subjects', 'schedule_exams', 'exams', 'class_sections', 'classes_id', 'exam_id'));
    }

}
