<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Classes;
use App\Section;
use App\Class_section;
use App\Http\Controllers\Controller;

class ClassSectionController extends Controller {

    public function add_class_section() {
        $add = Session::get('add');
        if ($add == 1) {
            $academic_year_id = Session::get('academic_year_id');
            $classes = DB::select(DB::raw("SELECT id,class_name FROM `classes`where id NOT IN(SELECT class_id from class_sections WHERE section_id =0 AND academic_year_id = $academic_year_id) AND status=1"));
            return view('class_sections/add_class_section', compact('classes'));
        } else {
            return redirect('view-class-sections');
        }
    }

    public function get_sections(Request $request) {
        $class_id = $request->input('data1');
        $academic_year_id = Session::get('academic_year_id');
        $sections = DB::select(DB::raw("SELECT id,section_name FROM `sections`where id NOT IN(SELECT section_id from class_sections WHERE class_id=$class_id AND academic_year_id = $academic_year_id) AND status=1"));
        return ($sections);
    }

    public function do_add_class_section(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_id' => 'required',
        ]);
        $class_id = $request['class_id'];
        $check_section = Class_section::where('class_id', $class_id)->where('academic_year_id', Session::get('academic_year_id'))->value('section_id');
        if (COUNT($check_section) != 0) {
            if (($request['section_id']) == '') {
                return redirect('add-class-section')->with(['message1-danger' => 'class  already having section(s),Please select section.']);
            }
        }
        $created_user_id = Session::get('user_login_id');
        $class = Classes::where('id', $request['class_id'])->value('class_name');
        $section = Section::where('id', $request['section_id'])->value('section_name');
        $c_ids = DB::select(DB::raw("SELECT max(id) as c_id FROM class_sections"));
        if ($c_ids != ''):
            $c_ids = $c_ids[0]->c_id;
        else:
            $c_ids = 0;
        endif;
        $clas = $c_ids + 1;
        $class_sections = new Class_section();
        $class_sections->c_id = $clas;
        $class_sections->class_id = $request['class_id'];
        $class_sections->section_id = $request['section_id'];
        $class_sections->created_user_id = $created_user_id;
        $class_sections->academic_year_id = $academic_year_id;
        $data = array(
            'log_type' => ' class or class-section added successfully!',
            'message' => 'Added',
            'new_value' => $class . ' - ' . $section,
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_sections->save();
        return redirect('view-class-sections')->with(['message-success' => 'class ' . $class . '  ' . $section . ' added successfully.']);
    }

    public function view_class_sections() {
        $class_sections = Class_section::where('academic_year_id', Session::get('academic_year_id'))->orderBy('created_at', 'desc')->get();
        $teachers = \App\Class_teacher::where('academic_year_id', Session::get('academic_year_id'))->get();
        $staffs = \App\Staff::where('academic_year_id', Session::get('academic_year_id'))->get();
        return view('class_sections/view_class_sections', compact('class_sections', 'teachers', 'staffs'));
    }

    public function edit_class_section($class_section_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $class_sections = Class_section::where('id', $class_section_id)->where('academic_year_id', Session::get('academic_year_id'))->get();
            $class_id = $class_sections[0]->class_id;
            $sections = DB::select(DB::raw("SELECT id,section_name FROM `sections`where id NOT IN(SELECT section_id from class_sections WHERE class_id=$class_id AND id !=$class_section_id AND academic_year_id = $academic_year_id)  AND status=1"));
            return view('class_sections/edit_class_section', compact('class_sections', 'sections'));
        } else {
            return redirect('view-class-sections');
        }
    }

    public function do_edit_class_section(Request $request, $class_section_id) {
        $class_section = Class_section::where('id', $class_section_id)->get();
        $classes = $class_section[0]->classes->class_name;
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_id' => 'required',
            'section_id' => 'required',
        ]);
        $class_sections = Class_section::find($class_section_id);
        $class_sections->class_id = $request['class_id'];
        $class_sections->section_id = $request['section_id'];
        $class_sections->updated_user_id = $created_user_id;
        //$class_sections->academic_year_id = $academic_year_id;
        $class = Classes::where('id', $request['class_id'])->value('class_name');
        $section = Section::where('id', $request['section_id'])->value('section_name');
        $data = array(
            'log_type' => 'Class-section updated successfully!',
            'message' => 'updated',
            'new_value' => $class . ' - ' . $section,
            'old_value' => $classes,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_sections->update();
        return redirect('view-class-sections')->with(['message-success' => 'class ' . $class . ' - ' . $section . ' updated successfully.']);
    }

    public function make_inactive_class_section($class_section_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $class_sections = Class_section::where('id', $class_section_id)->get();
            $class = $class_sections[0]->classes->class_name;
            if (($class_sections[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_sections[0]->sections->section_name;
            }
            Class_section::where('id', $class_section_id)->update(['status' => 0]);
            return redirect('view-class-sections')->with(['message-warning' => 'class ' . $class . '  ' . $section . ' inactivated successfully.']);
        } else {
            return redirect('view-class-sections');
        }
    }

    public function make_active_class_section($class_section_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $class_sections = Class_section::where('id', $class_section_id)->get();
            $class = $class_sections[0]->classes->class_name;
            if (($class_sections[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_sections[0]->sections->section_name;
            }
            Class_section::where('id', $class_section_id)->update(['status' => 1]);
            return redirect('view-class-sections')->with(['message-info' => 'class ' . $class . '  ' . $section . ' activated successfully.']);
        } else {
            return redirect('view-class-sections');
        }
    }

    public function delete_class_section($class_section_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $class_sections = Class_section::where('id', $class_section_id)->get();
            $class = $class_sections[0]->classes->class_name;
            if (($class_sections[0]->section_id) == '0') {
                $section = '';
            } else {
                $section = $class_sections[0]->sections->section_name;
            }
            $data = array(
                'log_type' => 'class  deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $class . '' . $section,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Class_section::where('id', $class_section_id)->delete();
            return redirect('view-class-sections')->with(['message-danger' => 'class ' . $class . '  ' . $section . ' deleted successfully.']);
        } else {
            return redirect('view-class-sections');
        }
    }

}
