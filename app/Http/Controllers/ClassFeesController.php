<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Class_fee;
use App\Http\Controllers\Controller;

class ClassFeesController extends Controller {

    public function add_class_fee() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-class-fees');
        }
        $fee_types = \App\Fee_type::where('status', 1)->get();
        $fees = \App\Fee::where('status', 1)->where('non_editable', 0)->get();
        return view('class_fees/add_class_fee', compact('fee_types', 'fees'));
    }

    public function get_fee_classes(Request $request) {
        $fee_id = $request->input('fee_id');
        $academic_year_id = Session::get('academic_year_id');
        $classes = DB::select(DB::raw("SELECT class_sections.id,classes.class_name,sections.section_name,class_sections.section_id FROM `class_sections` LEFT JOIN classes ON classes.id=class_sections.class_id LEFT JOIN sections ON sections.id=class_sections.section_id WHERE class_sections.id NOT IN(SELECT class_section_id FROM class_fees WHERE fee_id=$fee_id AND academic_year_id = $academic_year_id) AND class_sections.academic_year_id = $academic_year_id AND class_sections.status=1"));
        return($classes);
    }

    public function do_add_class_fee(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_id' => 'required',
            'fee_type_id' => 'required',
            'class_section_id' => 'required',
            'fee_amount' => 'required',
        ]);
        $classes = $request['class_section_id'];
        if (!empty($classes)):
            foreach ($classes as $class):
                $class_sectionss = \App\Class_section::where('id', $class)->where('academic_year_id', $academic_year_id)->get();
                $class_id = $class_sectionss[0]->class_id;
                if (($class_sectionss[0]->section_id) != 0) {
                    $section_id = $class_sectionss[0]->section_id;
                } else {
                    $section_id = '';
                }
                $class_f_ids = DB::select(DB::raw("SELECT max(id) as c_f_id FROM class_fees"));
                if ($class_f_ids != ''):
                    $class_f_id = $class_f_ids[0]->c_f_id;
                else:
                    $class_f_id = 0;
                endif;
                $cf = $class_f_id + 1;

                $class_fees = new Class_fee();
                $class_fees->class_f_id = $cf;
                $class_fees->class_section_id = $class;
                $class_fees->class_id = $class_id;
                $class_fees->section_id = $section_id;
                $class_fees->fee_id = $request['fee_id'];
                $class_fees->fee_type_id = $request['fee_type_id'];
                $class_fees->fee_amount = $request['fee_amount'];
                $class_fees->created_user_id = $created_user_id;
                $class_fees->academic_year_id = $academic_year_id;
                $class_fees->save();
            endforeach;
        endif;
        $data = array(
            'log_type' => ' Fee  added to class successfully!',
            'message' => 'Added',
            'new_value' => $request['fee_amount'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-class-fees')->with(['message-success' => 'Fee amount ' . $request['fee_amount'] . ' added successfully.']);
    }

    public function view_class_fee() {
        $academic_year_id = Session::get('academic_year_id');
        $class_fees = Class_fee::orderBy('created_at', 'desc')->where('academic_year_id', $academic_year_id)->get();
        return view('class_fees/view_class_fees', compact('class_fees'));
    }

    public function edit_class_fee($class_fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $class_fees = Class_fee::where('id', $class_fee_id)->get();
            return view('class_fees/edit_class_fee', compact('class_fees'));
        } else {
            return redirect('view-class-fees');
        }
    }

    public function do_edit_class_fee(Request $request, $class_fee_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        ;
        $this->validate($request, [
            'fee_amount' => 'required'
        ]);
        $class_fees = Class_fee::find($class_fee_id);
        $class_fees->fee_amount = $request['fee_amount'];
        $class_fees->updated_user_id = $created_user_id;
        // $class_fees->academic_year_id = $academic_year_id;
        $old_values = Class_fee::find($class_fee_id);

        $data = array(
            'log_type' => 'Fee amount updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['fee_amount'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $class_fees->update();
        return redirect('view-class-fees')->with(['message-success' => 'Fee amount ' . $request['fee_amount'] . ' updated successfully.']);
    }

    public function make_inactive_class_fee($class_fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            Class_fee::where('id', $class_fee_id)->update(['status' => 0]);
            return redirect('view-class-fees')->with(['message-warning' => 'Class fee inactivated successfully.']);
        } else {
            return redirect('view-class-fees');
        }
    }

    public function make_active_class_fee($class_fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            Class_fee::where('id', $class_fee_id)->update(['status' => 1]);
            return redirect('view-class-fees')->with(['message-info' => 'Class fee activated successfully.']);
        } else {
            return redirect('view-class-fees');
        }
    }

    public function delete_class_fee($class_fee_id) {
        $academic_year_id = Session::get('academic_year_id');
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $created_user_id = Session::get('user_login_id');
            $old_values = Class_fee::where('id', $class_fee_id)->get();
            $data = array(
                'log_type' => 'Class fee deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Class_fee::where('id', $class_fee_id)->delete();
            return redirect('view-class-fees')->with(['message-danger' => 'Class fee deleted successfully.']);
        } else {
            return redirect('view-class-fees');
        }
    }

}
