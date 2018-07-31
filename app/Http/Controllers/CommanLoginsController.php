<?php

namespace App\Http\Controllers;

use \App\Student;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommanLoginsController extends Controller {

    public function view_institute_students(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $admission_types = \App\Student_type::where('status', 1)->get();
        $class_id = 0;
        $classes_id = $request['class_section_id'];
        $admission_type_id = $request['student_type_id'];
        if ($request['class_section_id'] != '' && $admission_type_id == ''):
            $classes = \App\Class_section::whereIn('id', $classes_id)->get();
            $students = Student::whereIn('class_section_id', $classes_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($classes_id != '' && $admission_type_id != ''):
            $students = Student:: whereIn('student_type_id', $admission_type_id)->whereIn('class_section_id', $classes_id)->get();
        endif;
        if ($classes_id == '' && $admission_type_id != ''):
            $students = Student:: whereIn('student_type_id', $admission_type_id)->get();
        endif;
        return view('common_logins/view_institute_students', compact('students', 'admission_type_id', 'admission_types', 'classes_id', 'class_sections', 'class_id', 'classes'));
    }

    public function view_institute_transport_students(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $students = Student::where('student_type_id', 1)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $routes = \App\Vehicle_route::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $stops = \App\Route_stop::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        $classes_id = $request['class_section_id'];
        $route_id = $request['route_id'];
        $stop_id = $request['stop_id'];

        if ($classes_id != '' && $route_id != '' && $stop_id != ''):
            $students = Student:: whereIn('stop_id', $stop_id)->whereIn('route_id', $route_id)->whereIn('class_section_id', $classes_id)->get();
        endif;
        if ($classes_id == '' && $route_id != '' && $stop_id != ''):
            $students = Student:: whereIn('stop_id', $stop_id)->whereIn('route_id', $route_id)->get();
        endif;
        if ($classes_id != '' && $route_id == '' && $stop_id != ''):
            $students = Student:: whereIn('stop_id', $stop_id)->whereIn('class_section_id', $classes_id)->get();
        endif;
        if ($classes_id != '' && $route_id != '' && $stop_id == ''):
            $students = Student:: whereIn('route_id', $route_id)->whereIn('class_section_id', $classes_id)->get();
        endif;
        if ($classes_id != '' && $route_id == '' && $stop_id == ''):
            $students = Student:: whereIn('class_section_id', $classes_id)->get();
        endif;
        if ($classes_id == '' && $route_id != '' && $stop_id == ''):
            $students = Student:: whereIn('route_id', $route_id)->get();
        endif;
        if ($classes_id == '' && $route_id == '' && $stop_id != ''):
            $students = Student:: whereIn('stop_id', $stop_id)->get();
        endif;
        return view('common_logins/view_institute_transport_students', compact('students', 'routes', 'stops', 'class_sections', 'classes_id', 'route_id', 'stop_id'));
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
            $classes = \App\Class_section::whereIn('id', $classes_id)->get();
            $students = Student::whereIn('class_section_id', $classes_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        return view('common_logins/view_institute_students', compact('students', 'admission_type_id', 'admission_types', 'classes_id', 'class_sections', 'class_id', 'classes'));
    }

    public function view_staffs() {
        $academic_year_id = Session::get('academic_year_id');
        $staffs = \App\Staff::where('status', 1)->where('user_type_id',4)->where('academic_year_id', $academic_year_id)->get();
        return view('common_logins/view_staff', compact('staffs'));
    }

    public function student_books() {
        $student_id = Session::get('student_id');
        $books = \App\Assign_book::leftjoin('return_books', 'assign_books.id', '=', 'return_books.assign_book_id')
                        ->where('student_id', $student_id)->get();
        return view('common_logins/student_books', compact('books'));
    }

    public function driver_route_students() {
        $staff_id = Session::get('staff_id');
        $route_id = \App\Vehicle_driver::where('staff_id', $staff_id)->value('route_id');
        $students = \App\Student::leftjoin('route_stops', 'route_stops.id', '=', 'students.stop_id')->where('student_type_id', 1)
                        ->where('students.route_id', $route_id)->get();
        return view('common_logins/driver_route_students', compact('students'));
    }

    public function driver_all_routes() {
        $staff_id = Session::get('staff_id');
        $drivers = \App\Vehicle_driver::where('staff_id', $staff_id)->get();
        return view('common_logins/driver_all_vehicle_drivers', compact('drivers'));
    }

    public function driver_my_stops() {
        $staff_id = Session::get('staff_id');
        $route_id = \App\Vehicle_driver::where('staff_id', $staff_id)->value('route_id');
        $stops = \App\Route_stop::where('route_id', $route_id)->get();
        return view('common_logins/driver_route_stops', compact('stops'));
    }

}
