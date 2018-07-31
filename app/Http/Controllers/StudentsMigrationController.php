<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StudentsMigrationController extends Controller {

    public function classes_migration() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/classes_migration', compact('present_years'));
    }

    public function get_f_a_y_classes(Request $request) {
        $academic_year_id = $request['academic_year_id'];
        $staff = DB::select(DB::raw("SELECT s.id, s.last_name,s.first_name,d.title as d_title FROM staff s LEFT JOIN staff_types st ON st.id=s.staff_type_id LEFT JOIN staff_departments d ON d.id=s.staff_department_id WHERE s.academic_year_id=$academic_year_id AND s.migrated=0"));
        $classes = \App\Class_section::leftjoin('classes', 'classes.id', '=', 'class_sections.class_id')
                        ->leftjoin('sections', 'sections.id', '=', 'class_sections.section_id')
                        ->select('classes.class_name', 'sections.section_name', 'class_sections.c_id')
                        ->where('class_sections.migrated', 0)->where('class_sections.status', 1)->where('class_sections.academic_year_id', $academic_year_id)->get();
        $new_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE  to_date  >= CURRENT_DATE AND id !=$academic_year_id "));
        $timings = \App\Institute_timing::where('academic_year_id', $academic_year_id)
                        ->where('migrated', 0)->where('status', 1)->get();
        $old_classes = \App\Class_section::leftjoin('classes', 'classes.id', '=', 'class_sections.class_id')
                        ->leftjoin('sections', 'sections.id', '=', 'class_sections.section_id')
                        ->select('classes.class_name', 'sections.section_name', 'class_sections.c_id')
                        ->where('class_sections.status', 1)->where('class_sections.academic_year_id', $academic_year_id)->get();
        $transport_fees = DB::select(DB::raw("SELECT tf.id,ft.fee_name,f.fee_title,tf.transport_fee,v.route_title,r.stop_name FROM transport_fees tf LEFT JOIN fees f ON f.id=tf.fee_id LEFT JOIN fee_types ft ON ft.id=tf.fee_type_id  LEFT JOIN vehicle_routes v ON v.id=tf.route_id LEFT JOIN route_stops r ON r.id=tf.stop_id WHERE tf.academic_year_id=$academic_year_id AND tf.migrated=0"));


        $datas = [
            'classes' => $classes,
            'new_years' => $new_years,
            'timings' => $timings,
            'staff' => $staff,
            'old_classes' => $old_classes,
            'transport_fees' => $transport_fees,
        ];
        return($datas);
    }

    public function get_t_a_y_classes(Request $request) {
        $academic_year_id = $request['academic_year_id'];
        $staff = DB::select(DB::raw("SELECT s.id, s.last_name,s.first_name,d.title as d_title FROM staff s LEFT JOIN staff_types st ON st.id=s.staff_type_id LEFT JOIN staff_departments d ON d.id=s.staff_department_id WHERE s.academic_year_id=$academic_year_id"));
        $n_classes = \App\Class_section::leftjoin('classes', 'classes.id', '=', 'class_sections.class_id')
                        ->leftjoin('sections', 'sections.id', '=', 'class_sections.section_id')
                        ->select('classes.class_name', 'sections.section_name', 'class_sections.id')
                        ->where('class_sections.status', 1)->where('class_sections.academic_year_id', $academic_year_id)->get();
        $timings = \App\Institute_timing::where('academic_year_id', $academic_year_id)
                        ->where('status', 1)->get();
        $transport_fees = DB::select(DB::raw("SELECT tf.id,ft.fee_name,f.fee_title,tf.transport_fee,v.route_title,r.stop_name FROM transport_fees tf LEFT JOIN fees f ON f.id=tf.fee_id LEFT JOIN fee_types ft ON ft.id=tf.fee_type_id  LEFT JOIN vehicle_routes v ON v.id=tf.route_id LEFT JOIN route_stops r ON r.id=tf.stop_id WHERE tf.academic_year_id=$academic_year_id "));

        $new_datas = [
            'classes' => $n_classes,
            'timings' => $timings,
            'staff' => $staff,
            'transport_fees' => $transport_fees,
        ];
        return($new_datas);
    }

    public function update_migrated_classes(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'from_class_section_id' => 'required',
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
        ]);

        $from_class_section_id = $request['from_class_section_id'];
        foreach ($from_class_section_id as $new_classes):
            $from_class_sections = \App\Class_section::where('id', $new_classes)->get();
            $f_class_id = $from_class_sections[0]->class_id;
            if (($from_class_sections[0]->section_id) != 0) {
                $f_section_id = $from_class_sections[0]->section_id;
            } else {
                $f_section_id = '';
            }
            $class_sections = new \App\Class_section();
            $class_sections->c_id = $new_classes;
            $class_sections->class_id = $f_class_id;
            $class_sections->section_id = $f_section_id;
            $class_sections->created_user_id = $created_user_id;
            $class_sections->academic_year_id = $request['to_academic_year_id'];
            $class_sections->save();

            \App\Class_section::where('id', $new_classes)->update(['migrated' => 1]);
        endforeach;
        return redirect('classes-migration')->with(['message-success' => 'Classes Migrated successfully.']);
    }

    public function migrate_timings() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/institute_timings_migration', compact('present_years'));
    }

    public function update_migrated_timings(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'institute_timing_id' => 'required',
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
        ]);

        $old_timings = $request['institute_timing_id'];
        foreach ($old_timings as $new_timings):
            $timings = \App\Institute_timing::where('id', $new_timings)->get();
            $institute_timings = new \App\Institute_timing();
            $institute_timings->title = $timings[0]->title;
            $institute_timings->time_id = $new_timings;
            $institute_timings->class_start = $timings[0]->class_start;
            $institute_timings->class_end = $timings[0]->class_end;
            $institute_timings->duration = $timings[0]->duration;
            $institute_timings->created_user_id = $created_user_id;
            $institute_timings->academic_year_id = $request['to_academic_year_id'];
            $institute_timings->save();
            \App\Institute_timing::where('id', $new_timings)->update(['migrated' => 1]);
        endforeach;
        return redirect('migrate-timings')->with(['message-success' => 'Timings Migrated successfully.']);
    }

    public function students_migration() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/add_student_migration', compact('present_years'));
    }

    public function academic_year_classes(Request $request) {
        $academic_year_id = $request['academic_year_id'];
        $classes = \App\Class_section::leftjoin('classes', 'classes.id', '=', 'class_sections.class_id')
                        ->leftjoin('sections', 'sections.id', '=', 'class_sections.section_id')
                        ->select('classes.class_name', 'sections.section_name', 'class_sections.id')
                        ->where('class_sections.status', 1)->where('class_sections.academic_year_id', $academic_year_id)->get();
        return($classes);
    }

    public function to_academic_year_classes(Request $request) {
        $academic_year_id = $request['academic_year_id'];
        $classes = \App\Class_section::leftjoin('classes', 'classes.id', '=', 'class_sections.class_id')
                        ->leftjoin('sections', 'sections.id', '=', 'class_sections.section_id')
                        ->select('classes.class_name', 'sections.section_name', 'class_sections.id')
                        ->where('class_sections.status', 1)->where('class_sections.academic_year_id', $academic_year_id)->get();
        return($classes);
    }

    public function migrated_students(Request $request) {
        $class_section_id = $request['class_section_id'];
        $academic_year_id = $request['academic_year_id'];
        $class_fees = DB::select(DB::raw("SELECT cf.id,ft.fee_name,f.fee_title,fee_amount FROM class_fees cf LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id  WHERE cf.academic_year_id=$academic_year_id AND cf.migrated=0 AND cf.class_section_id=$class_section_id "));
        $class_schedules = DB::select(DB::raw("SELECT cs.id,c.class_name,s.section_name,su.subject_name,d.day_title,it.time_id,it.class_start,it.class_end FROM  class_subjects cs LEFT JOIN classes c ON c.id= cs.class_id LEFT JOIN sections s ON s.id=cs.section_id LEFT JOIN subjects su ON su.id=cs.subject_id
LEFT JOIN days d ON d.id=cs.day_id LEFT JOIN institute_timings it ON it.time_id=cs.institute_timing_id  WHERE cs.academic_year_id=$academic_year_id AND cs.migrated=0 AND cs.class_section_id=$class_section_id "));
        $students = \App\Student::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->where('status', 1)->where('promoted', 0)->get();
        $new_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE  to_date  >= CURRENT_DATE AND id !=$academic_year_id "));
        $result = [ 'students' => $students,
            'new_years' => $new_years,
            'class_schedules' => $class_schedules,
            'class_fees' => $class_fees,
        ];
        return($result);
    }

    public function migrated_class_students(Request $request) {
        $class_section_id = $request['class_section_id'];
        $academic_year_id = $request['academic_year_id'];
        $class_fees = DB::select(DB::raw("SELECT cf.id,ft.fee_name,f.fee_title,fee_amount FROM class_fees cf LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id  WHERE cf.academic_year_id=$academic_year_id AND cf.class_section_id=$class_section_id "));
        $class_schedule = DB::select(DB::raw("SELECT cs.id,c.class_name,s.section_name,su.subject_name,d.day_title,it.time_id,it.class_start,it.class_end FROM  class_subjects cs LEFT JOIN classes c ON c.id= cs.class_id LEFT JOIN sections s ON s.id=cs.section_id LEFT JOIN subjects su ON su.id=cs.subject_id
LEFT JOIN days d ON d.id=cs.day_id LEFT JOIN institute_timings it ON it.id=cs.institute_timing_id  WHERE cs.academic_year_id=$academic_year_id AND cs.class_section_id=$class_section_id"));
        $students = DB::select(DB::raw("SELECT * FROM `students` WHERE class_section_id=$class_section_id AND academic_year_id=$academic_year_id "));
        $results = [ 'students' => $students,
            'class_schedule' => $class_schedule,
            'class_fees' => $class_fees,
        ];
        return($results);
    }

    public function class_schedule_migration_update(Request $request) {
        $created_user_id = Session::get('user_login_id');

        $this->validate($request, [
            'from_class_section_id' => 'required',
            'to_class_section_id' => 'required',
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
            'class_subject_id' => 'required',
        ]);
        $to_class_sections = \App\Class_section::where('id', $request['to_class_section_id'])->get();
        $t_class_id = $to_class_sections[0]->class_id;
        if (($to_class_sections[0]->section_id) != 0) {
            $t_section_id = $to_class_sections[0]->section_id;
        } else {
            $t_section_id = '';
        }
        $class_subj = $request['class_subject_id'];

        foreach ($class_subj as $class_subject):
            $schedules = \App\Class_subject::where('id', $class_subject)->get();

            // $time_id= \App\Institute_timing::where('time_id',$schedules[0]->institute_timing_id)->where('academic_year_id', $request['to_academic_year_id'])->value('id');
            $class_subjects = new \App\Class_subject();
            $class_subjects->c_sub_id = $schedules[0]->id;
            $class_subjects->day_id = $schedules[0]->day_id;
            $class_subjects->class_section_id = $request['to_class_section_id'];
            $class_subjects->subject_id = $schedules[0]->subject_id;
            $class_subjects->institute_timing_id = $schedules[0]->institute_timing_id;
            $class_subjects->start_time = $schedules[0]->start_time;
            $class_subjects->end_time = $schedules[0]->end_time;
            $class_subjects->class_id = $t_class_id;
            $class_subjects->section_id = $t_section_id;
            $class_subjects->created_user_id = $created_user_id;
            $class_subjects->academic_year_id = $request['to_academic_year_id'];
            $class_subjects->save();
            \App\Class_subject::where('id', $schedules[0]->id)->where('academic_year_id', $request['from_academic_year_id'])->update(['migrated' => 1]);
        endforeach;

        return redirect('class-schedule-migration')->with(['message-success' => 'Migrated successfully.']);
    }

    public function save_migrated_class(Request $request) {
        $this->validate($request, [
            'from_class_section_id' => 'required',
            'to_class_section_id' => 'required',
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
            'student_id' => 'required',
        ]);
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = $request['to_academic_year_id'];
        $from_class_sections = \App\Class_section::where('id', $request['from_class_section_id'])->get();
        $f_class_id = $from_class_sections[0]->class_id;
        if (($from_class_sections[0]->section_id) != 0) {
            $f_section_id = $from_class_sections[0]->section_id;
        } else {
            $f_section_id = '';
        }
        $to_class_sections = \App\Class_section::where('id', $request['to_class_section_id'])->get();
        $t_class_id = $to_class_sections[0]->class_id;
        if (($to_class_sections[0]->section_id) != 0) {
            $t_section_id = $to_class_sections[0]->section_id;
        } else {
            $t_section_id = '';
        }
        $students = $request['student_id'];

        if (COUNT($students) != 0) {
            foreach ($students as $student):
                $id = \App\Student::where('student_id', $student)->where('academic_year_id', $request['from_academic_year_id'])->value('id');
                $migrations = new \App\Migration_student();
                $migrations->from_class_section_id = $request['from_class_section_id'];
                $migrations->from_academic_year_id = $request['from_academic_year_id'];
                $migrations->to_class_section_id = $request['to_class_section_id'];
                $migrations->to_academic_year_id = $request['to_academic_year_id'];
                $migrations->students = $id;
                $migrations->from_class_id = $f_class_id;
                $migrations->from_section_id = $f_section_id;
                $migrations->to_class_id = $t_class_id;
                $migrations->to_section_id = $t_section_id;
                $migrations->created_user_id = $created_user_id;
                $migrations->academic_year_id = $academic_year_id;
                $migrations->save();
            endforeach;
        }
        foreach ($students as $student):
            $id = \App\Student::where('student_id', $student)->where('academic_year_id', $request['from_academic_year_id'])->value('id');
            $old_students = \App\Student::where('class_section_id', $request['from_class_section_id'])
                            ->where('id', $id)->where('academic_year_id', $request['from_academic_year_id'])->get();
            foreach ($old_students as $new_student):
                $studentss = new \App\Student();
                $studentss->student_id = $new_student->student_id;
                $studentss->student_type_id = $new_student->student_type_id;
                $studentss->class_section_id = $request['to_class_section_id'];
                $studentss->class_id = $t_class_id;
                $studentss->section_id = $t_section_id;
                $studentss->joined_class_id = $new_student->joined_class_id;
                $studentss->joined_section_id = $new_student->joined_section_id;
                $studentss->unique_id = $new_student->unique_id;
                $studentss->admission_number = $new_student->admission_number;
                $studentss->roll_number = $new_student->roll_number;
                $studentss->joined_roll_number = $new_student->joined_roll_number;
                $studentss->joined_date = $new_student->joined_date;
                $studentss->first_name = $new_student->first_name;
                $studentss->middle_name = $new_student->middle_name;
                $studentss->last_name = $new_student->last_name;
                $studentss->email = $new_student->email;
                $studentss->contact_number = $new_student->contact_number;
                $studentss->emergency_number = $new_student->emergency_number;
                $studentss->date_of_birth = $new_student->date_of_birth;
                $studentss->add_rights = $new_student->add_rights;
                $studentss->view_rights = $new_student->view_rights;
                $studentss->edit_rights = $new_student->edit_rights;
                $studentss->aadhaar_number = $new_student->aadhaar_number;
                $studentss->father_number = $new_student->father_number;
                $studentss->father_name = $new_student->father_name;
                $studentss->mother_number = $new_student->mother_number;
                $studentss->mother_name = $new_student->mother_name;
                $studentss->present_address = $new_student->present_address;
                $studentss->permanent_address = $new_student->permanent_address;
                $studentss->gender = $new_student->gender;
                $studentss->blood_group = $new_student->blood_group;
                $studentss->religion = $new_student->religion;
                $studentss->nationality = $new_student->nationality;
                $studentss->caste = $new_student->caste;
                $studentss->domicile = $new_student->domicile;
                $studentss->physical_handicapped = $new_student->physical_handicapped;
                $studentss->siblings = $new_student->siblings;
                $studentss->mark_1 = $new_student->mark_1;
                $studentss->mark_2 = $new_student->mark_2;
                $studentss->hobbies = $new_student->hobbies;
                $studentss->user_login_id = $new_student->user_login_id;
                $studentss->created_user_id = $created_user_id;
                $studentss->academic_year_id = $request['to_academic_year_id'];
                $studentss->student_academic_year_id = $new_student->student_academic_year_id;
                $studentss->user_type_id = $new_student->user_type_id;
                $studentss->photo = $new_student->photo;

                $studentss->route_id = $new_student->route_id;
                $studentss->stop_id = $new_student->stop_id;
                $studentss->save();
            endforeach;
        endforeach;

        foreach ($students as $s) {
            $id = \App\Student::where('student_id', $s)->where('academic_year_id', $request['from_academic_year_id'])->value('id');
            $s_academic_years = new \App\Student_academic_year();
            $s_academic_years->class_id = $t_class_id;
            $s_academic_years->section_id = $t_section_id;
            $s_academic_years->new = 0;
            $s_academic_years->class_section_id = $request['to_class_section_id'];
            $s_academic_years->student_id = $id;
            $s_academic_years->created_user_id = $created_user_id;
            $s_academic_years->academic_year_id = $request['to_academic_year_id'];
            $s_academic_years->save();
            $old_students = \App\Student::where('class_section_id', $request['from_class_section_id'])
                            ->where('student_id', $id)->where('academic_year_id', $request['from_academic_year_id'])->update(['promoted' => 1]);
        }


        foreach ($students as $student):
            // $id = \App\Student::where('student_id', $student)->where('academic_year_id', $request['to_academic_year_id'])->value('id');
            $new_student = \App\Student::where('class_section_id', $request['to_class_section_id'])
                            ->where('student_id', $student)->where('academic_year_id', $request['to_academic_year_id'])->get();
            $old_parents = \App\Parent_detail::
                    where('student_id', $student)->where('academic_year_id', $request['from_academic_year_id'])->get();
            foreach ($old_parents as $new_parent):
                $parent = new \App\Parent_detail();
                foreach ($new_student as $new) {
                    $parent->student_id = $new->id;
                }
                $parent->user_type_id = $new_parent->user_type_id;
                $parent->mother_name = $new_parent->mother_name;
                $parent->parent_id = $new_parent->parent_id;
                $parent->mother_email = $new_parent->mother_email;
                $parent->mother_number = $new_parent->mother_number;
                $parent->mother_education = $new_parent->mother_education;
                $parent->mother_occupation = $new_parent->mother_occupation;
                $parent->father_name = $new_parent->father_name;
                $parent->father_email = $new_parent->father_email;
                $parent->father_number = $new_parent->father_number;
                $parent->father_education = $new_parent->father_education;
                $parent->father_occupation = $new_parent->father_occupation;
                $parent->family_income = $new_parent->family_income;
                $parent->address = $new_parent->address;
                $parent->user_login_id = $new_parent->user_login_id;
                $parent->created_user_id = $new_parent->created_user_id;
                $parent->academic_year_id = $request['to_academic_year_id'];
                $parent->user_type_id = $new_parent->user_type_id;
                $parent->mother_photo = $new_parent->mother_photo;
                $parent->father_photo = $new_parent->father_photo;
                $parent->save();
            endforeach;
        endforeach;
        $data = array(
            'log_type' => ' Students Migrated  successfully!',
            'message' => 'Added',
            'new_value' => 'Students ',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-migrated-classes')->with(['message-success' => 'Migrated successfully.']);
    }

    public function view_migrated_classes_students() {
        $migrations = \App\Migration_student::orderBy('created_at', 'desc')->get();
        return view('students_migration/view_students_migration', compact('migrations'));
    }

    public function class_schedule_migration() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/class_schedule_migration', compact('present_years'));
    }

    public function staff_migration() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/staff_migration', compact('present_years'));
    }

    public function save_migrated_satff(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'staff_id' => 'required',
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
        ]);

        $staffs = $request['staff_id'];
        foreach ($staffs as $staff):
            $institute_staff = \App\Staff::where('id', $staff)->get();
            $staff_details = new \App\Staff();
            $staff_details->staff_id = $institute_staff[0]->staff_id;
            $staff_details->first_name = $institute_staff[0]->first_name;
            $staff_details->middle_name = $institute_staff[0]->middle_name;
            $staff_details->last_name = $institute_staff[0]->last_name;
            $staff_details->email = $institute_staff[0]->email;
            $staff_details->experience = $institute_staff[0]->experience;
            $staff_details->contact_number = $institute_staff[0]->contact_number;
            $staff_details->emergency_number = $institute_staff[0]->emergency_number;
            $staff_details->date_of_birth = $institute_staff[0]->date_of_birth;
            $staff_details->joined_date = $institute_staff[0]->joined_date;
            $staff_details->staff_type_id = $institute_staff[0]->staff_type_id;
            $staff_details->staff_department_id = $institute_staff[0]->staff_department_id;
            $staff_details->employee_id = $institute_staff[0]->employee_id;
            $staff_details->emp_designation = $institute_staff[0]->emp_designation;
            $staff_details->add_rights = $institute_staff[0]->add_rights;
            $staff_details->view_rights = $institute_staff[0]->view_rights;
            $staff_details->edit_rights = $institute_staff[0]->edit_rights;
            $staff_details->delete_rights = $institute_staff[0]->delete_rights;
            $staff_details->basic_salary = $institute_staff[0]->basic_salary;
            $staff_details->incentives = $institute_staff[0]->incentives;
            $staff_details->other_salary = $institute_staff[0]->other_salary;
            $staff_details->salary_cuttings = $institute_staff[0]->salary_cuttings;
            $staff_details->total_salary = $institute_staff[0]->total_salary;
            $staff_details->aadhaar_number = $institute_staff[0]->aadhaar_number;
            $staff_details->father_number = $institute_staff[0]->father_number;
            $staff_details->father_name = $institute_staff[0]->father_name;
            $staff_details->present_address = $institute_staff[0]->present_address;
            $staff_details->permanent_address = $institute_staff[0]->permanent_address;
            $staff_details->gender = $institute_staff[0]->gender;
            $staff_details->blood_group = $institute_staff[0]->blood_group;
            $staff_details->religion = $institute_staff[0]->religion;
            $staff_details->nationality = $institute_staff[0]->nationality;
            $staff_details->caste = $institute_staff[0]->caste;
            $staff_details->marital_status = $institute_staff[0]->marital_status;
            $staff_details->spouse_name = $institute_staff[0]->spouse_name;
            $staff_details->occupation = $institute_staff[0]->occupation;
            $staff_details->child_number = $institute_staff[0]->child_number;
            $staff_details->domicile = $institute_staff[0]->domicile;
            $staff_details->staff_unique_id = $institute_staff[0]->staff_unique_id;
            $staff_details->user_login_id = $institute_staff[0]->user_login_id;
            $staff_details->created_user_id = $created_user_id;
            $staff_details->academic_year_id = $request['to_academic_year_id'];
            $staff_details->user_type_id = $institute_staff[0]->user_type_id;
            $staff_details->photo = $institute_staff[0]->photo;
            $staff_details->save();
            \App\Staff::where('id', $staff)->update(['migrated' => 1]);
        endforeach;
        return redirect('staff-migration')->with(['message-success' => 'Staff Migrated successfully.']);
    }

    public function class_fee_migration() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/class_fee_migration', compact('present_years'));
    }

    public function save_migrated_class_fees(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'from_class_section_id' => 'required',
            'to_class_section_id' => 'required',
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
            'class_fee_id' => 'required',
        ]);
        $to_class_sections = \App\Class_section::where('id', $request['to_class_section_id'])->get();
        $t_class_id = $to_class_sections[0]->class_id;
        if (($to_class_sections[0]->section_id) != 0) {
            $t_section_id = $to_class_sections[0]->section_id;
        } else {
            $t_section_id = '';
        }
        $class_fes = $request['class_fee_id'];

        foreach ($class_fes as $class_fee):
            $fees = \App\Class_fee::where('id', $class_fee)->get();
            $class_fees = new \App\Class_fee();
            $class_fees->class_f_id = $fees[0]->class_f_id;
            $class_fees->class_section_id = $request['to_class_section_id'];
            $class_fees->class_id = $t_class_id;
            $class_fees->section_id = $t_section_id;
            $class_fees->fee_id = $fees[0]->fee_id;
            $class_fees->fee_type_id = $fees[0]->fee_type_id;
            $class_fees->fee_amount = $fees[0]->fee_amount;
            $class_fees->created_user_id = $created_user_id;
            $class_fees->academic_year_id = $request['to_academic_year_id'];
            $class_fees->save();
            \App\Class_fee::where('id', $fees[0]->id)->where('academic_year_id', $request['from_academic_year_id'])->update(['migrated' => 1]);
        endforeach;

        return redirect('class-fee-migration')->with(['message-success' => 'Migrated successfully.']);
    }

    public function transport_fee_migration() {
        $present_years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date, '%d-%m-%Y') AS from_year,DATE_FORMAT(to_date,'%d-%m-%Y') AS to_year,id,YEAR(from_date) as year1,YEAR(to_date) as year2 FROM academic_years WHERE   CURRENT_DATE >= from_date "));
        return view('students_migration/transport_fee_migration', compact('present_years'));
    }

    public function save_migrated_transport_fees(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'from_academic_year_id' => 'required',
            'to_academic_year_id' => 'required',
            'transport_fee_id' => 'required',
        ]);
        $transport_fes = $request['transport_fee_id'];

        foreach ($transport_fes as $transport_fee):
            $fees = \App\Transport_fee::where('id', $transport_fee)->get();
            $transport_fees = new \App\Transport_fee();
            $transport_fees->stop_id = $fees[0]->stop_id;
            $transport_fees->transport_f_id = $fees[0]->id;
            $transport_fees->route_id = $fees[0]->route_id;
            $transport_fees->fee_id = $fees[0]->fee_id;
            $transport_fees->fee_type_id = $fees[0]->fee_type_id;
            $transport_fees->transport_fee = $fees[0]->transport_fee;
            $transport_fees->created_user_id = $created_user_id;
            $transport_fees->academic_year_id = $request['to_academic_year_id'];
            $transport_fees->save();
            \App\Transport_fee::where('id', $fees[0]->id)->where('academic_year_id', $request['from_academic_year_id'])->update(['migrated' => 1]);
        endforeach;

        return redirect('transport-fee-migration')->with(['message-success' => 'Migrated successfully.']);
    }

}
