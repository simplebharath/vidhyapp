<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Staff_type;
use App\Http\Controllers\Controller;

class StaffTypesController extends Controller {

    public function add_staff_type() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-staff-types');
        }
        return view('staff_type/add_staff_type');
    }

    public function do_add_staff_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:staff_types',
        ]);
        $staff_types = new Staff_type();
        $staff_types->title = $request['title'];
        $staff_types->created_user_id = $created_user_id;
        $staff_types->academic_year_id = $academic_year_id;
        $staff_types->save();
        $data = array(
            'log_type' => ' staff type added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-staff-types')->with(['message-success' => 'staff type ' . $request['title'] . ' added successfully.']);
    }

    public function view_staff_types() {
        $staff_types = Staff_type::orderBy('created_at', 'desc')->paginate(20);
        return view('staff_type/view_staff_types', compact('staff_types'));
    }

    public function edit_staff_type($staff_type_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $staff_types = Staff_type::where('id', $staff_type_id)->get();
            return view('staff_type/edit_staff_type', compact('staff_types'));
        } else {
            return redirect('view-staff-types');
        }
    }

    public function do_edit_staff_type(Request $request, $staff_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:staff_types,title,' . Staff_type::where('id', $staff_type_id)->value('id'),
        ]);
        $staff_types = Staff_type::find($staff_type_id);
        $staff_types->title = $request['title'];
        $staff_types->updated_user_id = $created_user_id;
        $staff_types->academic_year_id = $academic_year_id;
        $old_values = Staff_type::find($staff_type_id);

        $data = array(
            'log_type' => 'Staff type updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff_types->update();
        return redirect('view-staff-types')->with(['message-success' => 'Staff type ' . $request['title'] . ' updated successfully.']);
    }

    public function make_inactive_staff_type($staff_type_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $title = Staff_type::where('id', $staff_type_id)->value('title');
            Staff_type::where('id', $staff_type_id)->update(['status' => 0]);
            return redirect('view-staff-types')->with(['message-warning' => 'Staff type ' . $title . ' inactivated successfully.']);
        } else {
            return redirect('view-staff-types');
        }
    }

    public function make_active_staff_type($staff_type_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {

            $title = Staff_type::where('id', $staff_type_id)->value('title');
            Staff_type::where('id', $staff_type_id)->update(['status' => 1]);
            return redirect('view-staff-types')->with(['message-info' => 'Staff type ' . $title . ' activated successfully.']);
        } else {
            return redirect('view-staff-types');
        }
    }

    public function delete_staff_type($staff_type_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $title = Staff_type::where('id', $staff_type_id)->value('title');
            $old_values = Staff_type::where('id', $staff_type_id)->get();
            if(COUNT($old_values[0]->departments)==0){
            $data = array(
                'log_type' => 'staff type deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            
            Staff_type::where('id', $staff_type_id)->delete();
            }else{
                return redirect('view-staff-types')->with(['message1-danger' => 'The staff type used in another table,you can\'t delete.' ]);
            }
            return redirect('view-staff-types')->with(['message-success' => 'Staff type ' . $title . ' deleted successfully.']);
        } else {
            return redirect('view-staff-types')->with(['message1-danger' => 'You don\'t have permission to do this action' ]);
        }
    }

}
