<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StudentMarksController extends Controller {

    public function get_students_marks() {
        $add = Session::get('add');
        if ($add == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $exams = DB::select(DB::raw("SELECT e.id,e.title FROM schedule_exams se LEFT JOIN exams e ON se.exam_id=e.id WHERE se.academic_year_id=$academic_year_id GROUP BY se.exam_id"));
            $class_sections = \App\Class_section::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
            return view('students_marks/get_students', compact('class_sections', 'exams'));
        } else {
            return redirect('view-students-marks');
        }
    }

    public function get_exam_class(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $exam_id = $request['exam_id'];
        $classes = DB::select(DB::raw("SELECT cs.id,c.class_name,s.section_name FROM class_sections cs LEFT JOIN classes c ON c.id=cs.class_id LEFT JOIN sections s ON s.id=cs.section_id 
WHERE cs.id IN(SELECT class_section_id FROM schedule_exams WHERE exam_id =$exam_id AND academic_year_id=$academic_year_id) GROUP BY cs.id"));
        return($classes);
    }

    public function get_exam_subjects(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $exam_id = $request['exam_id'];
        $class_section_id = $request->input('class_section_id');
        $subjects = DB::select(DB::raw("SELECT subjects.id,subject_name FROM subjects WHERE id IN(SELECT subject_id FROM schedule_exams WHERE class_section_id=$class_section_id AND exam_id =$exam_id AND academic_year_id=$academic_year_id)AND id NOT IN(SELECT subject_id FROM student_marks WHERE class_section_id=$class_section_id AND exam_id =$exam_id AND academic_year_id=$academic_year_id)"));
        return($subjects);
    }

    public function get_exam_students(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $class_section_id = $request['class_section_id'];
            $subject_id = $request['subject_id'];
            $exam_id = $request['exam_id'];
            $academic_year_id = Session::get('academic_year_id');
            if ($subject_id == ''):
                $exam = \App\Class_exam::where('exam_id', $exam_id)->where('class_section_id', $class_section_id)->get();
                $class_name = \App\Class_section::where('id', $class_section_id)->get();
                $subjects = DB::select(DB::raw("SELECT subjects.id,subjects.subject_name,schedule_exams.exam_date,schedule_exams.exams_start_time,schedule_exams.exams_end_time,schedule_exams.pass_marks,schedule_exams.max_marks,schedule_exams.exam_duration FROM `schedule_exams` LEFT JOIN subjects ON subjects.id=schedule_exams.subject_id WHERE schedule_exams.exam_id=$exam_id AND schedule_exams.class_section_id=$class_section_id AND schedule_exams.academic_year_id=$academic_year_id AND subjects.id NOT IN(SELECT subject_id FROM student_marks WHERE class_section_id=$class_section_id AND exam_id =$exam_id AND academic_year_id=$academic_year_id)"));
                if (COUNT($subjects) == 0):
                    return redirect('get-students-marks')->with(['message-success' => 'Marks  already added to this Class exam.']);
                    ;
                endif;
                $students = \App\Student::where('class_section_id', $class_section_id)->where('status', 1)->get();
            else:
                $exam = \App\Class_exam::where('exam_id', $exam_id)->where('class_section_id', $class_section_id)->get();
                $class_name = \App\Class_section::where('id', $class_section_id)->get();
                $subjects = DB::select(DB::raw("SELECT subjects.id,subjects.subject_name,schedule_exams.exam_date,schedule_exams.exams_start_time,schedule_exams.exams_end_time,schedule_exams.pass_marks,schedule_exams.max_marks,schedule_exams.exam_duration FROM `schedule_exams` LEFT JOIN subjects ON subjects.id=schedule_exams.subject_id WHERE schedule_exams.exam_id=$exam_id AND schedule_exams.class_section_id=$class_section_id AND schedule_exams.academic_year_id=$academic_year_id AND schedule_exams.subject_id=$subject_id"));
                $students = \App\Student::where('class_section_id', $class_section_id)->where('status', 1)->where('academic_year_id', $academic_year_id)->get();

            endif;

            return view('students_marks/add_student_marks', compact('students', 'class_name', 'subjects', 'exam'));
        } else {
            return redirect('view-students-marks');
        }
    }

    public function save_students_marks(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        foreach ($request['marks_obtained'] as $key => $marks) {
            foreach ($marks as $subject_id => $subject_marks) {
                $this->validate($request, [
                        // 'marks_obtained.'.$subject_marks => 'required',
                ]);
            }
        }
        $exam_id = $request['exam_id'];
        $marks_obtained = $request['marks_obtained'];
        foreach ($marks_obtained as $key => $marks):
            $student_id = $key;
            foreach ($marks as $subject_id => $subject_marks):
                $sub_id = $subject_id;
                $marks = $subject_marks;
                $schedule_exam_id = \App\Schedule_exam::where('class_section_id', $request['class_section_id'])->where('academic_year_id', $academic_year_id)->where('exam_id', $exam_id)->where('subject_id', $sub_id)->value('id');
                $student_marks = new \App\Student_mark();
                $student_marks->exam_id = $exam_id;
                $student_marks->student_id = $student_id;
                $student_marks->subject_id = $sub_id;
                $student_marks->marks_obtained = $marks;
                $student_marks->schedule_exam_id = $schedule_exam_id;
                $student_marks->class_section_id = $request['class_section_id'];
                $student_marks->created_user_id = $created_user_id;
                $student_marks->academic_year_id = $academic_year_id;
                $student_marks->save();
            endforeach;
        endforeach;
        $data = array(
            'log_type' => ' Student Marks added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-students-marks')->with(['message-success' => 'Marks  added successfully.']);
    }

    public function view_students_marks() {
        $academic_year_id = Session::get('academic_year_id');
        $marks = \App\Student_mark::where('academic_year_id', $academic_year_id)->get();
        return view('students_marks/view_students_marks', compact('marks'));
    }

    public function edit_students_marks($exam_id, $class_section_id, $subject_id) {
        $marks = \App\Student_mark::where('exam_id', $exam_id)->where('class_section_id', $class_section_id)->where('subject_id', $subject_id)->get();
        return view('students_marks/edit_students_marks', compact('marks'));
    }

    public function update_students_marks(Request $request, $exam_id, $class_section_id, $subject_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'marks_obtained' => 'required',
        ]);
        $marks_obtained = $request['marks_obtained'];
        if (!empty($marks_obtained)):
            foreach ($marks_obtained as $key => $marks):
                $student_marks = \App\Student_mark::where('exam_id', $exam_id)->where('class_section_id', $class_section_id)->where('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->where('student_id', $key)->update(['marks_obtained' => $marks]);
            endforeach;
        endif;
        $data = array(
            'log_type' => ' Transport Fee  added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-students-marks')->with(['message-success' => 'Marks updated successfully']);
    }

    public function marks_added_students(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $exams = DB::select(DB::raw("SELECT e.id,e.title FROM student_marks sm LEFT JOIN exams e ON sm.exam_id=e.id WHERE e.academic_year_id=$academic_year_id GROUP BY sm.exam_id"));
            $students = 0;
            return view('students_marks/edit_exam_marks', compact('students', 'exams'));
        } else {
            return redirect('view-students-marks');
        }
    }

    public function edit_exam_class(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $exam_id = $request['exam_id'];
        $classes = DB::select(DB::raw("SELECT cs.id,c.class_name,s.section_name FROM class_sections cs LEFT JOIN classes c ON c.id=cs.class_id LEFT JOIN sections s ON s.id=cs.section_id 
WHERE cs.id IN(SELECT class_section_id FROM student_marks WHERE exam_id =$exam_id AND student_marks.academic_year_id=$academic_year_id) AND cs.academic_year_id=$academic_year_id GROUP BY cs.id"));
        return($classes);
    }

    public function edit_exam_subjects(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $exam_id = $request['exam_id'];
        $class_section_id = $request->input('class_section_id');
        $subjects = DB::select(DB::raw("SELECT subjects.id,subject_name FROM subjects WHERE id IN(SELECT subject_id FROM student_marks WHERE class_section_id=$class_section_id AND exam_id =$exam_id AND academic_year_id=$academic_year_id)"));
        return($subjects);
    }

    public function edit_student_subject_marks(Request $request) {
        $add = Session::get('add');
        if ($add == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $class_section_id = $request['class_section_id'];
            $subject_id = $request['subject_id'];
            $exam_id = $request['exam_id'];
            $exams = DB::select(DB::raw("SELECT e.id,e.title FROM student_marks sm LEFT JOIN exams e ON sm.exam_id=e.id WHERE sm.academic_year_id=$academic_year_id GROUP BY sm.exam_id"));

            if ($subject_id == ''):
                $exam = \App\Class_exam::where('exam_id', $exam_id)->where('class_section_id', $class_section_id)->get();
                $class_name = \App\Class_section::where('id', $class_section_id)->get();
                $subjects = DB::select(DB::raw("SELECT GROUP_CONCAT(student_marks.marks_obtained),GROUP_CONCAT(student_marks.student_id),GROUP_CONCAT(student_marks.subject_id),subjects.id,subjects.subject_name,schedule_exams.exam_date,schedule_exams.exams_start_time,schedule_exams.exams_end_time,schedule_exams.pass_marks,schedule_exams.max_marks,schedule_exams.exam_duration FROM  student_marks LEFT JOIN schedule_exams ON schedule_exams.id=student_marks.schedule_exam_id LEFT JOIN subjects ON subjects.id=student_marks.subject_id WHERE student_marks.exam_id=$exam_id AND student_marks.class_section_id=$class_section_id AND student_marks.academic_year_id=$academic_year_id GROUP BY student_marks.subject_id"));
                $marks = DB::select(DB::raw("SELECT GROUP_CONCAT(marks_obtained) as new_marks,GROUP_CONCAT(student_marks.student_id) as new_students,GROUP_CONCAT(student_marks.subject_id) as new_subjects, student_marks.id as student_mark_id,student_marks.class_section_id,student_marks.student_id,student_marks.marks_obtained,students.first_name,students.last_name,students.unique_id,students.photo,students.roll_number, subjects.id,subjects.subject_name,schedule_exams.exam_date,schedule_exams.exams_start_time,schedule_exams.exams_end_time,schedule_exams.pass_marks,schedule_exams.max_marks,schedule_exams.exam_duration FROM  student_marks LEFT JOIN schedule_exams ON schedule_exams.id=student_marks.schedule_exam_id
LEFT JOIN students ON students.id=student_marks.student_id
LEFT JOIN subjects ON subjects.id=student_marks.subject_id WHERE student_marks.exam_id=$exam_id AND student_marks.class_section_id=$class_section_id AND student_marks.academic_year_id=$academic_year_id GROUP BY student_marks.student_id"));
                $students = \App\Student::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->where('status', 1)->get();
            else:
                $marks = \App\Student_mark::where('exam_id', $exam_id)->where('class_section_id', $class_section_id)->where('subject_id', $subject_id)->where('academic_year_id', $academic_year_id)->get();
                return view('students_marks/edit_students_marks', compact('marks'));
            endif;

            return view('students_marks/edit_all_subject_marks', compact('students', 'class_name', 'marks', 'subjects', 'exam', 'exams'));
        } else {
            return redirect('view-students-marks');
        }
    }

    public function get_student_exam_subject_marks(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $exam_id = $request['exam_id'];
        $student_id = $request['student_id'];
        $subject_id = $request['subject_id'];
        $class_section_id = $request->input('class_section_id');
        $subjects = DB::select(DB::raw("SELECT marks_obtained,id FROM student_marks WHERE academic_year_id=$academic_year_id AND student_id=$student_id AND exam_id=$exam_id AND class_section_id=$class_section_id AND subject_id=$subject_id  "));
        return($subjects);
    }

    public function update_student_all_subject_marks(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        foreach ($request['marks_obtained'] as $key => $marks) {
            foreach ($marks as $subjects_id => $subject_marks) {
                $this->validate($request, [
                        // 'marks_obtained.'.$subject_marks => 'required',
                ]);
            }
        }
        $exam_id = $request['exam_id'];
        $marks_obtained = $request['marks_obtained'];
        foreach ($marks_obtained as $key => $marks):
            $student_id = $key;
            foreach ($marks as $subject_id => $subject_marks):
                $sub_id = $subject_id;
                $marks = $subject_marks;
                $schedule_exam_id = \App\Schedule_exam::where('class_section_id', $request['class_section_id'])->where('exam_id', $exam_id)->where('subject_id', $sub_id)->where('academic_year_id', $academic_year_id)->value('id');
                $id = \App\Student_mark::where('subject_id', $sub_id)->where('student_id', $student_id)->where('class_section_id', $request['class_section_id'])->where('exam_id', $exam_id)->where('academic_year_id', $academic_year_id)->value('id');
                $student_marks = \App\Student_mark::find($id);
                $student_marks->exam_id = $exam_id;
                $student_marks->student_id = $student_id;
                $student_marks->subject_id = $sub_id;
                $student_marks->marks_obtained = $marks;
                $student_marks->schedule_exam_id = $schedule_exam_id;
                $student_marks->class_section_id = $request['class_section_id'];
                $student_marks->created_user_id = $created_user_id;
                $student_marks->academic_year_id = $academic_year_id;
                $student_marks->update();
            endforeach;
        endforeach;
        $data = array(
            'log_type' => ' Student Marks updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-students-marks')->with(['message-success' => 'Marks  updated successfully.']);
    }

    public function save_student_exam_subject_marks(Request $request) {
        $student_id = $request['student_id'];
        $marks_obtained = $request['marks'];
        $e_id = $request['exam_id'];
        $c_id = $request['class_section_id'];
        $sub_id = $request['subject_id'];
        //$token= $request['token'];
        //$marks = DB::select(DB::raw("UPDATE `student_marks` SET `marks_obtained` = $marks_obtained WHERE class_section_id=$c_id AND exam_id=$e_id AND student_id=$student_id AND subject_id=$sub_id"));

        $marks = \App\Student_mark::where('student_id', $student_id)
                        ->where('exam_id', $e_id)->where('class_section_id', $c_id)
                        ->where('subject_id', $sub_id)->update(['marks_obtained' => $marks_obtained]);

        return($marks);
    }

}
