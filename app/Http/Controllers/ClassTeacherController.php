<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Class_teacher;
use App\Staff;
use App\Class_section;
use App\Http\Controllers\Controller;

class ClassTeacherController extends Controller {

    public function add_class_teacher($class_section_id) {
        $add = Session::get('add');
        if ($add == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $teacher = Class_teacher::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
            if (COUNT($teacher) == 1) {
                $class_teacher_id = $teacher[0]->id;
                return redirect('edit-class-teacher/' . $class_teacher_id)->with(['message-info' => 'Class teacher already added to this class, you can change and update here.']);
            }
            $class_sections = \App\Class_section::where('status', 1)->where('academic_year_id', $academic_year_id)->where('id', $class_section_id)->get();
            $staffs = DB::select(DB::raw("SELECT id,first_name,last_name,staff_department_id FROM staff where id NOT IN(SELECT staff_id from class_teachers WHERE academic_year_id = $academic_year_id) AND academic_year_id = $academic_year_id AND status=1 AND staff_type_id=1"));
            return view('class_teacher/add_class_teacher', compact('class_sections', 'staffs'));
        } else {
            return redirect('view-class-teachers');
        }
    }

    public function do_add_class_teacher(Request $request, $class_section_id) {
        $this->validate($request, [
            'class_section_id' => 'required',
            'staff_id' => 'required',
        ]);
        $academic_year_id = Session::get('academic_year_id');
        $teacher = Class_teacher::where('class_section_id', $class_section_id)->where('academic_year_id', $academic_year_id)->get();
        if (COUNT($teacher) != 0) {
            return redirect('add-class-teacher/' . $class_section_id)->with(['message1-danger' => 'Class teacher already exist to this class.If you want to change class teacher please do edit and update.']);
        }
        $class_sectionss = Class_section::where('id', $class_section_id)->get();
        $class_id = $class_sectionss[0]->class_id;
        $class_name = $class_sectionss[0]->classes->class_name;
        if (($class_sectionss[0]->section_id) != 0) {
            $section_id = $class_sectionss[0]->section_id;
            $section_name = $class_sectionss[0]->sections->section_name;
        } else {
            $section_id = '';
            $section_name = '';
        }
        $class_teacher = Staff::where('id', $request['staff_id'])->get();
        $name = $class_teacher[0]->first_name;
        $created_user_id = Session::get('user_login_id');
        $class_teachers = new Class_teacher();
        $class_teachers->class_section_id = $request['class_section_id'];
        $class_teachers->staff_id = $request['staff_id'];
        $class_teachers->class_id = $class_id;
        $class_teachers->section_id = $section_id;
        $class_teachers->created_user_id = $created_user_id;
        $class_teachers->academic_year_id = $academic_year_id;
        $data = array(
            'log_type' => ' class teacher added successfully!',
            'message' => 'Added',
            'new_value' => $class_name . ' - ' . $section_name . ' class Teacher ' . $name,
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_teachers->save();
        return redirect('view-class-teachers')->with(['message-success' => 'class ' . $class_name . '  ' . $section_name . ' class Teacher ', $name . ' added successfully.']);
    }

    public function view_class_teachers() {
        $academic_year_id = Session::get('academic_year_id');
        $class_teachers = Class_teacher::orderBy('created_at', 'desc')->where('academic_year_id', $academic_year_id)->get();
        return view('class_teacher/view_class_teachers', compact('class_teachers'));
    }

    public function edit_class_teacher($class_teacher_id) {
        $academic_year_id = Session::get('academic_year_id');
        $edit = Session::get('edit');
        if ($edit == 1) {
            $class_teachers = Class_teacher::where('id', $class_teacher_id)->get();
            $class_section_id = $class_teachers[0]->class_section_id;
            $teachers = DB::select(DB::raw("SELECT id,first_name,last_name,staff_department_id FROM staff where id NOT IN(SELECT staff_id from class_teachers WHERE class_section_id != $class_section_id AND academic_year_id = $academic_year_id) AND academic_year_id = $academic_year_id  AND status=1 AND staff_type_id=1"));
            return view('class_teacher/edit_class_teacher', compact('class_teachers', 'teachers'));
        } else {
            return redirect('view-class-teachers');
        }
    }

    public function do_edit_class_teacher(Request $request, $class_teacher_id) {
        $class_teacherss = Class_teacher::where('id', $class_teacher_id)->get();
        $classes = $class_teacherss[0]->classes->class_name;
        if ($class_teacherss[0]->section_id != 0) {
            $sections = $class_teacherss[0]->sections->section_name;
        } else {
            $sections = "";
        }
        $teacher = $class_teacherss[0]->teachers->first_name;
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_section_id' => 'required',
            'staff_id' => 'required',
        ]);
        $class_teachers = Class_teacher::find($class_teacher_id);
        $class_teachers->class_section_id = $request['class_section_id'];
        $class_teachers->staff_id = $request['staff_id'];
        $class_teachers->class_id = $class_teacherss[0]->class_id;
        if ($class_teacherss[0]->section_id != 0) {
            $class_teachers->section_id = $class_teacherss[0]->section_id;
        }
        $class_teachers->updated_user_id = $created_user_id;
        //$class_teachers->academic_year_id = $academic_year_id;
        $new_teacher = Staff::where('id', $request['staff_id'])->value('first_name');
        $data = array(
            'log_type' => 'Class Teacher updated successfully!',
            'message' => 'updated',
            'new_value' => $classes . ' - ' . $sections . ' ' . $teacher,
            'old_value' => $classes . ' - ' . $sections . ' ' . $new_teacher,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_teachers->update();
        if ($teacher == $new_teacher) {
            return redirect('view-class-teachers')->with(['message-success' => 'class ' . $classes . ' - ' . $sections . ' class  teacher ' . $teacher . ' updated successfully!']);
        } else {
            return redirect('view-class-teachers')->with(['message-success' => 'class ' . $classes . ' - ' . $sections . ' class  teacher ' . $teacher . '  changed to  ' . $new_teacher . '  and updated successfully.']);
        }
    }

    public function make_inactive_class_teacher($class_teacher_id) {
        $edit = Session::get('edit');
        if ($edit == 1) {
            $class_teacher = Class_teacher::where('id', $class_teacher_id)->get();
            $class = $class_teacher[0]->classes->class_name;
            $teacher = $class_teacher[0]->teachers->first_name;
            if (($class_teacher[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_teacher[0]->sections->section_name;
            }
            Class_teacher::where('id', $class_teacher_id)->update(['status' => 0]);
            return redirect('view-class-teachers')->with(['message-warning' => 'class ' . $class . '  ' . $section . ' class teacher  ' . $teacher . ' inactivated successfully']);
        } else {
            return redirect('view-class-teachers');
        }
    }

    public function make_active_class_teacher($class_teacher_id) {
        $edit = Session::get('edit');
        if ($edit == 1) {
            $class_teacher = Class_teacher::where('id', $class_teacher_id)->get();
            $class = $class_teacher[0]->classes->class_name;
            $teacher = $class_teacher[0]->teachers->first_name;
            if (($class_teacher[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_teacher[0]->sections->section_name;
            }
            Class_teacher::where('id', $class_teacher_id)->update(['status' => 1]);
            return redirect('view-class-teachers')->with(['message-info' => 'class ' . $class . '  ' . $section . ' class teacher  ' . $teacher . ' activated successfully.']);
        } else {
            return redirect('view-class-teachers');
        }
    }

    public function delete_class_teacher($class_teacher_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $class_teacher = Class_teacher::where('id', $class_teacher_id)->get();
            $class = $class_teacher[0]->classes->class_name;
            $teacher = $class_teacher[0]->teachers->first_name;
            if (($class_teacher[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_teacher[0]->sections->section_name;
            }
            $data = array(
                'log_type' => 'class teacher deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $class . ' - ' . $section . ' ' . $teacher,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Class_teacher::where('id', $class_teacher_id)->delete();
            return redirect('view-class-teachers')->with(['message-danger' => 'class ' . $class . '  ' . $section . '  class teacher  ' . $teacher . ' deleted successfully.']);
        } else {
            return redirect('view-class-teachers');
        }
    }

}
