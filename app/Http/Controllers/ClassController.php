<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Classes;
use App\Http\Controllers\Controller;

class ClassController extends Controller {

    public $subTitle;

    public function __construct() {
        
    }

    public function add_class() {
        $subTitle = Classes::subTitle();
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-classes');
        } else {
            return view('class/add_class', compact('subTitle'));
        }
    }

    public function do_add_class(Request $request) {
        $this->validate($request, Classes::classesValidationAdd());
        Classes::classesSaveOrUpdate($request);
        return redirect('view-classes')->with(['message-success' => 'class ' . $request['class_name'] . ' added successfully.']);
    }

    public function view_class() {
        $subTitle = Classes::subTitle();
        $classes = Classes::orderBy('created_at', 'desc')->get();
        return view('class/view_class', compact('classes', 'subTitle'));
    }

    public function edit_class($class_id) {
        $subTitle = Classes::subTitle();
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $classes = classes::where('id', $class_id)->get();
            return view('class/edit_class', compact('classes', 'subTitle'));
        } else {
            return redirect('view-classes');
        }
    }

    public function do_edit_class(Request $request, $class_id) {
        $this->validate($request, Classes::classesValidationEdit($class_id));
        Classes::classesSaveOrUpdate($request, $class_id);
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
