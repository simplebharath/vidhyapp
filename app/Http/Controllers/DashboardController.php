<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\Controller;

class DashboardController extends Controller {

    public function admin_dashboard() {
        $a_id = Session::get('academic_year_id');
        $current = \Carbon\Carbon::now()->toDateTimeString();
        //$date = date("d-m-Y", strtotime($current));
        $current_time = date("d/m/Y H:i", strtotime($current));
        $classes = \App\Class_section::where('academic_year_id', $a_id)->where('status', 1)->count();
        $section = \App\Class_section::where('academic_year_id', $a_id)->where('status', 1)->where('section_id', 0)->count();
        $students = \App\Student::where('academic_year_id', $a_id)->where('status', 1)->count();
        $girls = \App\Student::where('academic_year_id', $a_id)->where('status', 1)->where('gender', 'Female')->count();
        $staff = \App\Staff::where('academic_year_id', $a_id)->where('status', 1)->count();
        $teaching = \App\Staff::where('academic_year_id', $a_id)->where('status', 1)->where('staff_type_id', 1)->count();
        $transport = \App\Vehicle_route::where('academic_year_id', $a_id)->where('status', 1)->count();
        $vehicles = \App\Vehicle::where('academic_year_id', $a_id)->where('status', 1)->count();
        $drivers = \App\Staff::where('academic_year_id', $a_id)->where('status', 1)->where('user_type_id', 6)->count();
        $events = \App\Event::where('academic_year_id', $a_id)->where('status', 1)->count();
        $u_coming = \App\Event::where('academic_year_id', $a_id)->where('status', 1)->whereDate('start_time', '<=', $current_time)->count();
        $exams = \App\Exam::where('academic_year_id', $a_id)->where('status', 1)->count();
        $marks = \App\Class_exam::where('academic_year_id', $a_id)->where('status', 1)->groupBy('exam_id')->count();
        $messages = \App\Parent_message::where('academic_year_id', $a_id)->count();
        $read = \App\Parent_message::where('academic_year_id', $a_id)->where('status', 0)->count();
        $income = \App\Payment_record::where('academic_year_id', $a_id)->where('status', 1)->sum('paid_amount');
        $expenditure = \App\Expense::where('academic_year_id', $a_id)->where('status', 1)->sum('amount');
        $message = \App\Parent_message::where('academic_year_id', $a_id)->orderBy('status', 'DESC')->orderBy('created_at', 'DESC')->get();
        $attendance_type_id = \App\Institute_detail::where('status', 1)->value('attendance_type_id');
        if (Session::has('new_date')) {
            $attendance_date = Session::get('new_date');
            //print_r($attendance_date);exit;
        } else {
            $attendance_date = date("Y-m-d", strtotime($current));
        }
        if ($attendance_type_id == 2) {
            $class_subjects = \App\Class_subject::where('academic_year_id', $a_id)->groupBy('subject_id')->groupBy('class_section_id')->get();
            foreach ($class_subjects as $c_id) {
                $section_id = $c_id->class_section_id;
                $subject_id = $c_id->subject_id;
                //$s_attendance[] = \App\Student_attendance::where('class_section_id',$section_id)->where('subject_id',$subject_id)->where('attendance_date', "2018-01-24")->where('attendance_status', 1)->get();
                $s_attendance[] = DB::select(DB::raw("SELECT classes.class_name,sections.section_name,subjects.subject_name,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present, COUNT(student_id) as total,class_section_id,subject_id FROM student_attendances 
LEFT JOIN subjects ON subjects.id=student_attendances.subject_id
LEFT JOIN class_sections ON class_sections.id=student_attendances.class_section_id
LEFT JOIN classes  ON class_sections.class_id=classes.id
LEFT JOIN sections ON sections.id=class_sections.section_id WHERE
attendance_date='$attendance_date' AND class_sections.id=$section_id AND subjects.id=$subject_id"));
            }
        }
        if ($attendance_type_id == 1) {
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $a_id)->get();
            foreach ($class_sections as $c_id) {
                $section_id = $c_id->id;
                $s_attendance[] = DB::select(DB::raw("SELECT classes.class_name, 
       sections.section_name, 
       subjects.subject_name, 
       Count(CASE 
               WHEN attendance_status = '1' THEN 1 
             END)        AS present, 
       Count(student_id) AS total, 
       class_section_id, 
       subject_id 
FROM   student_attendances 
       LEFT JOIN subjects 
              ON subjects.id = student_attendances.subject_id 
       LEFT JOIN class_sections 
              ON class_sections.id = student_attendances.class_section_id 
       LEFT JOIN classes 
              ON class_sections.class_id = classes.id 
       LEFT JOIN sections 
              ON sections.id = class_sections.section_id 
WHERE  attendance_date = '$attendance_date' 
       AND class_sections.id = $section_id"));
            }
        }

        return view('dashboard/dashboard', compact('vehicles', 'class_sections', 'attendance_type_id', 's_attendance', 'message', 'classes', 'section', 'students', 'girls', 'staff', 'teaching', 'transport', 'drivers', 'events', 'u_coming', 'exams', 'marks', 'messages', 'read', 'income', 'expenditure'));
    }

    public function attendance_chart() {
        $a_id = Session::get('academic_year_id');
//        $value = DB::select(DB::raw("SELECT class_sections.id,class_sections.class_id,class_sections.section_id, classes.class_name,sections.section_name,class_sections.id, COUNT(class_sections.id) as total_students FROM class_sections INNER JOIN students ON class_sections.id=students.class_section_id 
//LEFT JOIN classes ON classes.id=class_sections.class_id
//LEFT JOIN sections ON sections.id=class_sections.section_id WHERE class_sections.academic_year_id = $a_id AND students.status=1
//GROUP BY students.class_section_id"));
        $academic_year_id = Session::get('academic_year_id');
        $clas = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        foreach ($clas as $c) {
            $id = $c->id;
            $class[] = DB::select(DB::raw("SELECT class_sections.id,class_sections.class_id,class_sections.section_id, classes.class_name,sections.section_name,class_sections.id, COUNT(class_sections.id) as total_students FROM class_sections INNER JOIN students ON class_sections.id=students.class_section_id 
LEFT JOIN classes ON classes.id=class_sections.class_id
LEFT JOIN sections ON sections.id=class_sections.section_id WHERE students.status=1 AND class_sections.academic_year_id = $academic_year_id AND students.academic_year_id = $academic_year_id AND
class_sections.id =$id"));
        }
        foreach ($class as $cc) {
        foreach ($cc as $s) {
            if ($s->section_id == 0) {
                $section = "";
            } else {
                $section = ' - ' . $s->section_name;
            }
            $classes[] = $s->class_name . '' .  $section;
            $class_students[] = $s->total_students;
        }}
        $val[0] = [
            "label" => 'Total Students',
            "backgroundColor" => "#4D5360",
            "a_data" => $class_students
        ];
        $v['labels'] = $classes;
        $v['sets'] = $val;
        return Response()->json($v);
    }

    public function change_date_session(Request $request) {
        $d = $request['startdate'];
        $date = date("Y-m-d", strtotime($d));
        $request->session()->put('a_date', $d);
        $request->session()->put('new_date', $date);
        $value = "ss";
        return Response()->json($value);
    }

    public function get_events() {
        $a_id = Session::get('academic_year_id');
        $exams = \App\Schedule_exam::where('academic_year_id', $a_id)->where('status', 1)->get();
        foreach ($exams as $data1) {
            if ($data1->class_sections->section_id == 0) {
                $section = '';
            } else {
                $section = $data1->class_sections->sections->section_name;
            }
            $s_dates = date("Y-m-d", strtotime($data1->exam_date));

            $s_times = date("H:i", strtotime($data1->exams_start_time));
            $s_d_t = $s_dates . ' ' . $s_times;

            $e_times = date("H:i", strtotime($data1->exams_end_time));
            $e_d_t = $s_dates . ' ' . $e_times;

            $data[] = [
                'id' => $data1->id,
                'title' => $data1->exams->title . ' | Class : ' . $data1->classes->class_name . ' - ' . $section . ' | ' . $data1->subjects->subject_name . ' | ' . $data1->exams_start_time . ' - ' . $data1->exams_end_time,
                'start' => date("Y-m-d H:i", strtotime($s_d_t)),
                'end' => date("Y-m-d H:i", strtotime($e_d_t)),
                'allDay' => 0,
                'description' => '',
                'icon' => 'fa fa-pencil',
                'color' => '#4D5360'
            ];
        }
        $events = \App\Event::where('academic_year_id', $a_id)->where('status', 1)->get();
        foreach ($events as $data1) {
            $data[] = [
                'id' => $data1->id,
                'title' => $data1->events->title . ' | From: ' . $data1->start_time . ', To: ' . $data1->end_time . ' @ ' . $data1->venue,
                'start' => \Carbon\Carbon::createFromFormat('d/m/Y H:i', $data1->start_time)->format('Y-m-d H:i'),
                'end' => \Carbon\Carbon::createFromFormat('d/m/Y H:i', $data1->end_time)->format('Y-m-d H:i'),
                'allDay' => 0,
                'description' => '',
                'icon' => 'fa fa-calendar',
                'color' => 'FDB45C'
            ];
        }
        $holidays = \App\Institute_holiday::where('academic_year_id', $a_id)->where('status', 1)->get();
        foreach ($holidays as $data1) {
            $data[] = [
                'id' => $data1->id,
                'title' => $data1->title,
                'start' => date("Y-m-d", strtotime($data1->holiday_date)),
                'end' => date("Y-m-d", strtotime($data1->holiday_date)),
                'allDay' => 1,
                'description' => '',
                'icon' => 'fa-thumb-tack',
                'color' => '#F7464A'
            ];
        }
        return Response()->json($data);
    }

    public function get_class_students() {
        $a_id = Session::get('academic_year_id');
        $class_total = DB::select("SELECT count(student_id) as class_total,classes.class_name FROM `students` students LEFT JOIN classes classes ON classes.class_id=students.class_id where students.status=1 AND students.academic_year_id=$a_id GROUP BY students.class_id");
        return($class_total);
    }

    public function dashboard_search(Request $request) {
        $value = $request['search'];
        if ($value == "") {
           // $url=root();
          //  print_r(url()->previous());exit;
            return redirect('admin-dashboard');
        }
        //print_r($value);exit;
        $student_ids=  \App\Student::where('academic_year_id',Session::get('academic_year_id'))->pluck('id');
       // print_r($student_ids);exit;
        $students = \App\Student::whereIn('students.id',$student_ids)
                        ->whereHas('classes', function($query) use($value) {
                            $query->where('class_name', 'like', '%' . $value . '%');
                        })
                        ->orWhereHas('sections', function($query) use($value) {
                            $query->where('section_name', 'like', '%' . $value . '%');
                        })
                        ->orWhereHas('student_types', function($query) use($value) {
                            $query->where('title', 'like', '%' . $value . '%');
                        })
                        ->orWhere('students.first_name', 'like', '%' . $value . '%')
                        ->orWhere('students.last_name', 'like', '%' . $value . '%')
                        ->orWhere('students.email', 'like', '%' . $value . '%')
                        ->orWhere('students.contact_number', 'like', '%' . $value . '%')
                        ->orWhere('students.date_of_birth', 'like', '%' . $value . '%')
                        ->orWhere('students.mark_1', 'like', '%' . $value . '%')
                        ->orWhere('students.present_address', 'like', '%' . $value . '%')
                        ->orWhere('students.admission_number', 'like', '%' . $value . '%')
                        ->orWhere('students.roll_number', 'like', '%' . $value . '%')
                        ->orWhere('students.gender', 'like', '%' . $value . '%')
                        ->orWhere('students.aadhaar_number', 'like', '%' . $value . '%')
                     //   ->orWhere('father_name', 'like', '%' . $value . '%')
                        ->orWhere('students.father_number', 'like', '%' . $value . '%')
                        ->orWhere('students.mother_number', 'like', '%' . $value . '%')
                      //  ->orWhere('mother_name', 'like', '%' . $value . '%')
                        ->orWhere('students.permanent_address', 'like', '%' . $value . '%')
                        ->orWhere('students.caste', 'like', '%' . $value . '%')
                        ->orWhere('students.religion', 'like', '%' . $value . '%')
                        ->orWhere('students.domicile', 'like', '%' . $value . '%')
                        ->orWhere('students.nationality', 'like', '%' . $value . '%')
                        ->orWhere('students.unique_id', 'like', '%' . $value . '%')
                        ->orWhere('students.emergency_number', 'like', '%' . $value . '%')
                        
                        ->orderBy('students.created_at', 'desc')->get();
        return view('student_details/view_students', compact('students', 'value'));
    }




      

}
