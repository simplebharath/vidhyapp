<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Staff_department;
use App\Http\Controllers\Controller;

class StaffDepartmentsController extends Controller {

    public function add_staff_department() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-staff-departments');
        }
        $staff_types = \App\Staff_type::where('status', '1')->get();
        return view('staff_department/add_staff_department', compact('staff_types'));
    }

    public function do_add_staff_department(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required',
            'staff_type_id' => 'required'
        ]);
        $staff_departments = new Staff_department();
        $staff_departments->title = $request['title'];
        $staff_departments->staff_type_id = $request['staff_type_id'];
        $staff_departments->created_user_id = $created_user_id;
        $staff_departments->academic_year_id = $academic_year_id;
        $staff_departments->save();
        $staff_type = \App\Staff_type::where('id', $request['staff_type_id'])->value('title');
        $data = array(
            'log_type' => ' staff department added successfully!',
            'message' => 'Added',
            'new_value' => $staff_type . ' - ' . $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-staff-departments')->with(['message-success' => 'staff department ' . $staff_type . ' - ' . $request['title'] . ' added successfully.']);
    }

    public function view_staff_departments() {
        $staff_departments = Staff_department::orderBy('created_at', 'desc')->paginate(20);
        return view('staff_department/view_staff_departments', compact('staff_departments'));
    }

    public function edit_staff_department($staff_department_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $staff_departments = Staff_department::where('id', $staff_department_id)->get();
            $staff_types = \App\Staff_type::where('id', $staff_departments[0]->staff_type_id)->get();
            return view('staff_department/edit_staff_department', compact('staff_departments', 'staff_types'));
        } else {
            return redirect('view-staff-departments');
        }
    }

    public function do_edit_staff_department(Request $request, $staff_department_id) {
        $created_user_id = Session::get('user_login_id');
        $staff_type_id = Staff_department::where('id', $staff_department_id)->value('staff_type_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:staff_departments,title,' . Staff_department::where('id', $staff_department_id)->where('staff_type_id', $staff_type_id)->value('id'),
            'staff_type_id' => 'required'
        ]);
        $staff_departments = Staff_department::find($staff_department_id);
        $staff_departments->title = $request['title'];
        $staff_departments->staff_type_id = $request['staff_type_id'];
        $staff_departments->updated_user_id = $created_user_id;
        $staff_departments->academic_year_id = $academic_year_id;
        $old_values = Staff_department::find($staff_department_id);
        $staff_type = \App\Staff_type::where('id', $staff_departments->staff_type_id)->value('title');
        $data = array(
            'log_type' => 'Staff department updated successfully!',
            'message' => 'Updated',
            'new_value' => $staff_type . ' - ' . $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff_departments->update();
        return redirect('view-staff-departments')->with(['message-success' => 'Staff department ' . $staff_type . ' - ' . $request['title'] . ' updated successfully.']);
    }

    public function make_inactive_staff_department($staff_department_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $title = Staff_department::where('id', $staff_department_id)->value('title');
            Staff_department::where('id', $staff_department_id)->update(['status' => 0]);
            return redirect('view-staff-departments')->with(['message-warning' => 'Staff department ' . $title . ' inactivated successfully.']);
        } else {
            return redirect('view-staff-departments');
        }
    }

    public function make_active_staff_department($staff_department_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {

            $title = Staff_department::where('id', $staff_department_id)->value('title');
            Staff_department::where('id', $staff_department_id)->update(['status' => 1]);
            return redirect('view-staff-departments')->with(['message-info' => 'Staff department ' . $title . ' activated successfully.']);
        } else {
            return redirect('view-staff-departments');
        }
    }

    public function delete_staff_department($staff_department_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $title = Staff_department::where('id', $staff_department_id)->value('title');
            $old_values = Staff_department::where('id', $staff_department_id)->get();
            if (COUNT($old_values[0]->staff) == 0) {
                $data = array(
                    'log_type' => 'staff department deleted successfully!',
                    'message' => 'Deleted',
                    'new_value' => 'No new values',
                    'old_value' => $old_values,
                    'academic_year_id' => $academic_year_id,
                    'user_login_id' => $created_user_id);
                DB::table('log_details')->insert($data);
                Staff_department::where('id', $staff_department_id)->delete();
            } else {
                return redirect('view-staff-departments')->with(['message1-danger' => 'The staff department used in another table,you can\'t delete.']);
            }
            return redirect('view-staff-departments')->with(['message-success' => 'Staff department ' . $title . ' deleted successfully.']);
        } else {
            return redirect('view-staff-departments')->with(['message1-danger' => 'You don\'t have permission to do this action']);
        }
    }

}
