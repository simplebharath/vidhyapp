<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Class_section;
use App\Class_subject;
use Session;
use App\Student;
use Excel;
use App\Http\Controllers\Controller;

class ExcelController extends Controller {

    public function class_schedule_excel($class_section_id) {
        $classes = Class_section::where('id', $class_section_id)->get();
        if ($classes[0]->section_id != 0):
            $section = \App\Section::where('id', $classes[0]->section_id)->value('section_name');
        else:
            $section = '';
        endif;
        Excel::create($classes[0]->classes->class_name . ' ' . $section . ' - ' . 'Class Timetable', function ($excel) use($class_section_id) {
            $excel->sheet('Sheet 1', function ($sheet) use($class_section_id) {
                $academic_year_id = Session::get('academic_year_id');
                $classes = Class_section::where('id', $class_section_id)->get();
                $institutions = \App\Institute_detail::where('academic_year_id', $academic_year_id)->get();
                $class_subjects = Class_subject::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->orderBy('updated_at', 'desc')->get();

                $sheet->setPageMargin(array(0.25, 0.30, 0.25, 0.30));
                $sheet->setFontFamily('Comic Sans MS');
                $sheet->setStyle(array(
                    'font' => array(
                        'name' => 'Calibri',
                        'size' => 12,
                        'bold' => false
                    )
                ));
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A1:G1');
                $sheet->loadView('excel_files.class_schedule_excel', compact('classes', 'class_subjects', 'institutions'));
            });
        })->export('xls');
    }

    public function view_institute_students_excel(Request $request) {
        Excel::create('students', function ($excel) use($request) {
            $excel->sheet('Sheet 1', function ($sheet) use($request) {

                $academic_year_id = Session::get('academic_year_id');
                $institutions = \App\Institute_detail::where('academic_year_id', $academic_year_id)->get();
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
                $sheet->setPageMargin(array(0.25, 0.30, 0.25, 0.30));
                $sheet->setFontFamily('Comic Sans MS');
                $sheet->setStyle(array(
                    'font' => array(
                        'name' => 'Calibri',
                        'size' => 12,
                        'bold' => false
                    )
                ));
                $sheet->mergeCells('A2:G2');
                $sheet->mergeCells('A1:G1');
                $sheet->loadView('excel_files.view_institute_students_excel', compact('students', 'admission_type_id', 'admission_types', 'classes_id', 'class_sections', 'class_id', 'classes', 'institutions'));
            });
        })->export('xls');
    }

}
