<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Classes;
use App\Http\Controllers\Controller;

class ClassController extends Controller {

    public function add_class() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-classes');
        } else {
            return view('class/add_class');
        }
    }

    public function do_add_class(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_name' => 'required|unique:classes',
        ]);
        $classes = new Classes();
        $classes->class_name = $request['class_name'];
        $classes->created_user_id = $created_user_id;
        $classes->academic_year_id = $academic_year_id;
        $classes->save();
        $data = array(
            'log_type' => ' class added successfully!',
            'message' => 'Added',
            'new_value' => $request['class_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-classes')->with(['message-success' => 'class ' . $request['class_name'] . ' added successfully.']);
    }

    public function view_class() {
        $classes = Classes::orderBy('created_at', 'desc')->get();
        return view('class/view_class', compact('classes'));
    }

    public function edit_class($class_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $classes = classes::where('id', $class_id)->get();
            return view('class/edit_class', compact('classes'));
        } else {
            return redirect('view-classes');
        }
    }

    public function do_edit_class(Request $request, $class_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'class_name' => 'required|unique:classes,class_name,' . classes::where('id', $class_id)->value('id'),
        ]);
        $classes = classes::find($class_id);
        $classes->class_name = $request['class_name'];
        $classes->updated_user_id = $created_user_id;
        //$classes->academic_year_id = $academic_year_id;
        $old_values = classes::find($class_id);

        $data = array(
            'log_type' => 'Class updated successfully!',
            'message' => 'Added',
            'new_value' => $request['class_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $classes->update();
        return redirect('view-classes')->with(['message-success' => 'Class ' . $request['class_name'] . ' updated successfully.']);
    }

    public function make_inactive_class($class_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $class_name = classes::where('id', $class_id)->value('class_name');
            classes::where('id', $class_id)->update(['status' => 0]);
            return redirect('view-classes')->with(['message-warning' => 'Class ' . $class_name . ' inactivated successfully.']);
        } else {
            return redirect('view-classes');
        }
    }

    public function make_active_class($class_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {

            $class_name = Classes::where('id', $class_id)->value('class_name');
            Classes::where('id', $class_id)->update(['status' => 1]);
            return redirect('view-classes')->with(['message-info' => 'Class ' . $class_name . ' activated successfully.']);
        } else {
            return redirect('view-classes');
        }
    }

    public function delete_class($class_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($delete == 1) && ($view == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $class_name = classes::where('id', $class_id)->value('class_name');
            $old_values = classes::where('id', $class_id)->get();
            $data = array(
                'log_type' => 'class deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            classes::where('id', $class_id)->delete();
            return redirect('view-classes')->with(['message-danger' => 'Class ' . $class_name . ' deleted successfully.']);
        } else {
            return redirect('view-classes');
        }
    }

}
