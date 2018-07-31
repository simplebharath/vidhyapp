<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Mail;
use Hash;
use \App\Student;
use App\Student_type;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade as PDF;
use \Input as Input;
use App\Http\Controllers\Controller;

class StudentController extends Controller {

    public function add_student() {
        $add = Session::get('add');
        if ($add == 1) {
            $id = Session::get('academic_year_id');
            $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE id = $id"));
            $student_types = Student_type::where('status', '1')->get();
            $user_types = \App\User_type::where('id', 5)->get();
            $class_sections = \App\Class_section::where('academic_year_id', Session::get('academic_year_id'))->where('status', 1)->get();
            return view('student_details/add_student', compact('years', 'student_types', 'user_types', 'class_sections'));
        } else {
            return redirect('view-students');
        }
    }

    public function student_transport_route(Request $request) {
        $student_type_id = $request['student_type_id'];
        if ($student_type_id == 1):
            //  $routes = \App\Vehicle_route::where('status', 1)->get();
            $routes = DB::table('vehicle_drivers')
                    ->leftJoin('vehicle_routes', 'vehicle_routes.id', '=', 'vehicle_drivers.route_id')
                    ->select('vehicle_routes.id', 'route_from', 'route_to')
                    ->where('vehicle_drivers.status', 1)
                    ->orderBy('route_from', 'ASC')
                    ->get();
        else:
            $routes = '';
        endif;
        return($routes);
    }

    public function student_route_stops(Request $request) {
        $route_id = $request['route_id'];
        $stops = \App\Route_stop::where('route_id', $route_id)->where('status', 1)->get();
        return($stops);
    }

    public function view_students() {
        $students = Student::where('academic_year_id', Session::get('academic_year_id'))->orderBy('created_at', 'desc')->get();
        return view('student_details/view_students', compact('students'));
    }

    public function do_add_student(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_ids = \App\Institute_detail::where('status', '1')->get();
        $academic_year_id = Session::get('academic_year_id');
        $institute_code = $academic_year_ids[0]->institution_code;
        $student_ids = DB::select(DB::raw("SELECT max(id) as student_id FROM students"));
        if ($student_ids != ''):
            $student_id = $student_ids[0]->student_id;
        else:
            $student_id = 0;
        endif;
        $new_student_id = $student_id + 1001;
        $join = [$institute_code, 'S', $new_student_id];
        $student_unique_id = implode("-", $join);
        if ($request['student_type_id'] == 1):
            $this->validate($request, [
                'route_id' => 'required',
                'stop_id' => 'required'
            ]);
        endif;
        $this->validate($request, [
            'academic_year_id' => 'required',
            'user_type_id' => 'required',
            'student_type_id' => 'required',
            'class_section_id' => 'required',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'joined_date' => 'required',
            'first_name' => 'required|alpha_spaces|min:3|max:255',
            'last_name' => 'required|alpha_spaces',
            'email' => 'email|max:255|unique:students',
            'contact_number' => 'required|size:10|regex:/[0-9]{10}/',
            'emergency_number' => 'size:10|regex:/[0-9]{10}/',
            'user_name' => 'required|min:3|max:255|unique:user_logins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'date_of_birth' => 'required',
            'photo' => 'mimes:jpeg,bmp,png',
            'father_number' => 'required',
            'mother_name' => 'required|alpha_spaces|min:3|max:255',
            'father_name' => 'required|alpha_spaces|min:3|max:255',
            'present_address' => 'required',
            'gender' => 'required',
            'physical_handicapped' => 'required',
            'nationality' => 'required',
            'siblings' => 'required',
            'mark_1' => 'required',
        ]);
        $token = Hash::make($request['password']);
        $user_logins = new \App\User_login();
        $user_logins->user_name = $request['user_name'];
        $user_logins->password = $request['password'];
        $user_logins->user_type_id = $request['user_type_id'];
        $user_logins->token = $token;
        $user_logins->academic_year_id = $academic_year_id;
        $user_logins->save();
        $results = DB::select(DB::raw("SELECT max(id) as user_login_id FROM user_logins"));
        $user_login_id = $results[0]->user_login_id;

        $class_sections = \App\Class_section::where('id', $request['class_section_id'])->get();
        if ($class_sections[0]->section_id != 0):
            $section_id = $class_sections[0]->section_id;
        else: $section_id = '';
        endif;
        $new_id = $student_id + 1;
        $student = new Student();
        $student->student_id = $new_id;
        $student->student_type_id = $request['student_type_id'];
        $student->class_section_id = $request['class_section_id'];
        $student->class_id = $class_sections[0]->class_id;
        $student->section_id = $section_id;
        $student->joined_class_id = $class_sections[0]->class_id;
        $student->joined_section_id = $section_id;
        $student->unique_id = $student_unique_id;
        $student->admission_number = $request['admission_number'];
        $student->roll_number = $request['roll_number'];
        $student->joined_roll_number = $request['roll_number'];
        $student->joined_date = $request['joined_date'];
        $student->first_name = $request['first_name'];
        $student->middle_name = $request['middle_name'];
        $student->last_name = $request['last_name'];
        $student->email = $request['email'];
        $student->contact_number = $request['contact_number'];
        $student->emergency_number = $request['emergency_number'];
        $student->date_of_birth = $request['date_of_birth'];
        $student->add_rights = $request['add_rights'];
        $student->view_rights = $request['view_rights'];
        $student->edit_rights = $request['edit_rights'];
        $student->aadhaar_number = $request['aadhaar_number'];
        $student->father_number = $request['father_number'];
        $student->father_name = $request['father_name'];
        $student->mother_number = $request['mother_number'];
        $student->mother_name = $request['mother_name'];
        $student->present_address = $request['present_address'];
        $student->permanent_address = $request['permanent_address'];
        $student->gender = $request['gender'];
        $student->blood_group = $request['blood_group'];
        $student->religion = $request['religion'];
        $student->nationality = $request['nationality'];
        $student->caste = $request['caste'];
        $student->domicile = $request['domicile'];
        $student->physical_handicapped = $request['physical_handicapped'];
        $student->siblings = $request['siblings'];
        $student->mark_1 = $request['mark_1'];
        $student->mark_2 = $request['mark_2'];
        $student->hobbies = $request['hobbies'];
        $student->user_login_id = $user_login_id;
        $student->created_user_id = $created_user_id;
        $student->academic_year_id = $academic_year_id;
        $student->student_academic_year_id = $academic_year_id;
        $student->user_type_id = $request['user_type_id'];
        if ($request['student_type_id'] == 1):
            $student->route_id = $request['route_id'];
            $student->stop_id = $request['stop_id'];
        endif;
        if ($request->hasFile('photo')) {
            $file = Input::file('photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $img = $file->getClientOriginalName();
            $result = array_map('strrev', explode('.', strrev($img)));
            $name = $timestamp . '.' . $result[0];
            $file->move(public_path() . '/uploads/students/profile_photos/', $name);
            $student->photo = $name;
        }
        $student->save();

        $newest_student_id = DB::select(DB::raw("SELECT max(id) as student_id FROM students"));
        $s_academic_years = new \App\Student_academic_year();
        $s_academic_years->roll_number = $request['roll_number'];
        $s_academic_years->class_id = $class_sections[0]->class_id;
        $s_academic_years->section_id = $section_id;
        $s_academic_years->new = 1;
        $s_academic_years->class_section_id = $request['class_section_id'];
        $s_academic_years->student_id = $newest_student_id[0]->student_id;
        $s_academic_years->created_user_id = $created_user_id;
        $s_academic_years->academic_year_id = $academic_year_id;
        $s_academic_years->save();


        $data = array(
            'log_type' => ' Student added successfully!',
            'message' => 'Added',
            'new_value' => $request['user_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $student_id = Student::where('user_login_id', $user_login_id)->where('academic_year_id', $academic_year_id)->value('id');
        return redirect('add-parent/' . $student_id)->with(['message-success' => 'Student' . $request['user_name'] . ' added successfully.Please do add Parents information']);
    }

    public function edit_student($id) {
        $academic_year_id = Session::get('academic_year_id');
        $student_id = Student::where('id', $id)->value('student_id');
        $student = Student::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        if (COUNT($student) != 1) {
            return redirect('add-student');
        }
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $students = Student::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->get();
            $student_type_id = $student[0]->student_type_id;
            $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE id = $academic_year_id AND status=1"));
            $student_types = Student_type::where('id', $student_type_id)->get();
            if ($student_type_id == 1):
                $routes = \App\Vehicle_route::where('id', $students[0]->route_id)->get();
                $stops = \App\Route_stop::where('route_id', $students[0]->route_id)->get();
            else:
                $routes = '';
            endif;
            $user_types = \App\User_type::where('status', '1')->get();
            return view('student_details/edit_student', compact('years', 'stops', 'student_types', 'routes', 'user_types', 'students'));
        } else {
            return redirect('view-students');
        }
    }

    public function do_edit_student(Request $request, $student_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'academic_year_id' => 'required',
            'user_type_id' => 'required',
            'student_type_id' => 'required',
            'class_section_id' => 'required',
            'unique_id' => 'required',
            'admission_number' => 'required',
            'roll_number' => 'required',
            'joined_date' => 'required',
            'first_name' => 'required|alpha_spaces|min:3|max:255',
            'last_name' => 'required|alpha_spaces',
            'email' => 'email|max:255',
            'contact_number' => 'required|size:10|regex:/[0-9]{10}/',
            'emergency_number' => 'size:10|regex:/[0-9]{10}/',
            'date_of_birth' => 'required',
            'photo' => 'mimes:jpeg,bmp,png',
            'father_number' => 'required',
            'mother_name' => 'required',
            'father_name' => 'required',
            'present_address' => 'required',
            'gender' => 'required',
            'physical_handicapped' => 'required',
            'nationality' => 'required',
            'siblings' => 'required',
            'mark_1' => 'required',
        ]);
        $class_sections = \App\Class_section::where('id', $request['class_section_id'])->where('academic_year_id', $academic_year_id)->get();
        if ($class_sections[0]->section_id != 0):
            $section_id = $class_sections[0]->section_id;
        else: $section_id = '';
        endif;
        $student = Student::find($student_id);
        $student->student_type_id = $request['student_type_id'];
        $student->class_section_id = $request['class_section_id'];
        $student->class_id = $class_sections[0]->class_id;
        $student->section_id = $section_id;
        $student->joined_class_id = $class_sections[0]->class_id;
        $student->joined_section_id = $section_id;
        $student->unique_id = $request['unique_id'];
        $student->admission_number = $request['admission_number'];
        $student->roll_number = $request['roll_number'];
        $student->joined_roll_number = $request['roll_number'];
        $student->joined_date = $request['joined_date'];
        $student->first_name = $request['first_name'];
        $student->middle_name = $request['middle_name'];
        $student->last_name = $request['last_name'];
        $student->email = $request['email'];
        $student->contact_number = $request['contact_number'];
        $student->emergency_number = $request['emergency_number'];
        $student->date_of_birth = $request['date_of_birth'];
        $student->add_rights = $request['add_rights'];
        $student->view_rights = $request['view_rights'];
        $student->edit_rights = $request['edit_rights'];
        $student->aadhaar_number = $request['aadhaar_number'];
        $student->father_number = $request['father_number'];
        $student->father_name = $request['father_name'];
        $student->mother_number = $request['mother_number'];
        $student->mother_name = $request['mother_name'];
        $student->present_address = $request['present_address'];
        $student->permanent_address = $request['permanent_address'];
        $student->gender = $request['gender'];
        $student->blood_group = $request['blood_group'];
        $student->religion = $request['religion'];
        $student->nationality = $request['nationality'];
        $student->caste = $request['caste'];
        $student->domicile = $request['domicile'];
        $student->physical_handicapped = $request['physical_handicapped'];
        $student->siblings = $request['siblings'];
        $student->mark_1 = $request['mark_1'];
        $student->mark_2 = $request['mark_2'];
        $student->hobbies = $request['hobbies'];
        $student->updated_user_id = $created_user_id;
        //$student->academic_year_id = $academic_year_id;
        $student->user_type_id = $request['user_type_id'];
        $old_values = Student::find($student_id);
        if ($request['student_type_id'] == 1):
            $student->route_id = $request['route_id'];
            $student->stop_id = $request['stop_id'];
        endif;
        if ($request->hasFile('photo')) {
            $image = $old_values->photo;
            if ($image != '') {
                $image_student = public_path() . '/uploads/students/profile_photos/' . $image;
                if (file_exists($image_student)) {
                    unlink($image_student);
                }
            }
            $file = Input::file('photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $img = $file->getClientOriginalName();
            $result = array_map('strrev', explode('.', strrev($img)));
            $name = $timestamp . '.' . $result[0];
            $file->move(public_path() . '/uploads/students/profile_photos/', $name);
            $student->photo = $name;
        }

        $data = array(
            'log_type' => 'Student details updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['first_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        // $id=  Student::where('id',$student_id)->where('academic_year_id',$academic_year_id)->value('student_id');
        $student->update();
        return redirect('add-parent/' . $student_id)->with(['message-success' => 'Student ' . $request['first_name'] . ' updated successfully.']);
    }

    public function make_inactive_student($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $student = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['status' => 0]);
        \App\User_login::where('id', $student[0]->user_login_id)->update(['status' => 0]);
        return redirect('view-students')->with(['message-warning' => 'User ' . $student[0]->first_name . ' inactivated successfully.']);
    }

    public function make_active_student($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $student = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['status' => 1]);
        \App\User_login::where('id', $student[0]->user_login_id)->update(['status' => 1]);
        return redirect('view-students')->with(['message-info' => 'User ' . $student[0]->first_name . ' activated successfully.']);
    }

    public function delete_student($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $student = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $old_values = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        if (COUNT($old_values) == 1) {
            $image = $old_values->photo;
            if ($image != '') {
                $image_user = public_path() . '/uploads/students/profile_photos' . $image;
                if (file_exists($image_user)) {
                    unlink($image_user);
                }
            }
        }
        $data = array(
            'log_type' => 'class deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->delete();
        \App\User_login::where('id', $student[0]->user_login_id)->delete();
        return redirect('view-students')->with(['message-danger' => 'User ' . $student[0]->first_name . ' deleted successfully.']);
    }

    public function student_delete_right_make_no($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['delete_rights' => 0]);
        return redirect('view-students')->with(['message-warning' => 'Activity delete removed for student ' . $first_name . '']);
    }

    public function student_delete_right_make_yes($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['delete_rights' => 1]);
        return redirect('view-students')->with(['message-info' => 'Activity delete added for student ' . $first_name . '']);
    }

    public function student_edit_right_make_no($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['edit_rights' => 0]);
        return redirect('view-students')->with(['message-warning' => 'Activity edit removed for student ' . $first_name . '']);
    }

    public function student_edit_right_make_yes($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['edit_rights' => 1]);
        return redirect('view-students')->with(['message-info' => 'Activity edit added for student ' . $first_name . '']);
    }

    public function student_view_right_make_no($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['view_rights' => 0]);
        return redirect('view-students')->with(['message-warning' => 'Activity view removed for student ' . $first_name . '']);
    }

    public function student_view_right_make_yes($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['view_rights' => 1]);
        return redirect('view-students')->with(['message-info' => 'Activity view added for student ' . $first_name . '']);
    }

    public function student_add_right_make_no($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['add_rights' => 0]);
        return redirect('view-students')->with(['message-warning' => 'Activity add removed for student ' . $first_name . '']);
    }

    public function student_add_right_make_yes($student_id) {
        $academic_year_id = Session::get('academic_year_id');
        $first_name = Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('first_name');
        Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->update(['add_rights' => 1]);
        return redirect('view-students')->with(['message-info' => 'Activity add added for student ' . $first_name . '']);
    }

    public function student_summary_email(Request $request, $parent, $student_id) {
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
        $file = public_path() . "/downloads";
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $file . '/' . $student[0]->unique_id . "-" . $timestamp . ".pdf";
        $pdf->save($file_name);
        $url = $request->root();
        // Mail::raw('bulletins.print_bulletin', function ($message) {
        if ($parent == 1) {
            $mail = Mail::send('emails.parent_summary_email', ['student' => $student, 'institute' => $institute, 'url' => $url], function($message) use ($student, $file_name, $institute) {
                        if (file_exists($file_name)) {
                            $message->attach($file_name);
                        }
                        if ($student[0]->parents->father_email != "") {
                            $message->from($institute[0]->institution_email, $institute[0]->institution_name);
                            $message->to($student[0]->parents->father_email, $student[0]->father_name)->subject($student[0]->unique_id);
                        }
                    });
            if (file_exists($file_name)) {
                unlink($file_name);
            }
        }
        if ($parent == 2) {
            $mail = Mail::send('emails.student_summary_email', ['student' => $student, 'institute' => $institute, 'url' => $url], function($message) use ($student, $file_name, $institute) {
                        if (file_exists($file_name)) {
                            $message->attach($file_name);
                        }
                        if ($student[0]->email != "") {
                            $message->from($institute[0]->institution_email, $institute[0]->institution_name);
                            $message->to($student[0]->email, $student[0]->first_name)->subject($student[0]->unique_id);
                        }
                    });
            if (file_exists($file_name)) {
                unlink($file_name);
            }
        }


        if ($parent == 2) {
            return redirect('view-student-profile/' . $student[0]->id)->with(['message-success' => 'An Email has been sent to ' . $student[0]->first_name . ' ' . $student[0]->last_name . ' ( ' . $student[0]->email . ' ) ']);
        }
        if ($parent == 1) {
            return redirect('view-student-profile/' . $student[0]->id)->with(['message-success' => 'An Email has been sent to ' . $student[0]->father_name . ' ( ' . $student[0]->parents->father_email . ' ) ']);
        }
    }

}
