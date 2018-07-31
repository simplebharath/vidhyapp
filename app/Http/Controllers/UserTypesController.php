<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\User_type;
use App\Http\Controllers\Controller;

class UserTypesController extends Controller {

    public function add_user_types() {
        return view('user_types/add_user_types');
    }

    public function do_user_types(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:user_types',
        ]);
        $user_type = new User_type();
        $user_type->title = $request['title'];
        $user_type->created_user_id = $created_user_id;
        $user_type->academic_year_id = $academic_year_id;
        $user_type->save();
        $data = array(
            'log_type' => ' User_type added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-user-types')->with(['message-success' => 'user_types ' . $request['title'] . ' added successfully.']);
    }

    public function view_user_types() {
        $user_types = User_type::orderBy('created_at', 'asc')->get();
        return view('user_types/view_user_types', compact('user_types'));
    }

    public function edit_user_types($user_type_id) {
        $user_types = user_type::where('id', $user_type_id)->get();
        return view('user_types/edit_user_types', compact('user_types'));
    }

    public function do_edit_user_types(Request $request, $user_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:user_types,title,' . user_type::where('id', $user_type_id)->value('id'),
        ]);
        $user_type = user_type::find($user_type_id);
        $user_type->title = $request['title'];
        $user_type->updated_user_id = $created_user_id;
        $user_type->academic_year_id = $academic_year_id;
        $old_values = user_type::find($user_type_id);

        $data = array(
            'log_type' => 'User types updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $user_type->update();
        return redirect('view-user-types')->with(['message-success' => 'User type' . $request['title'] . ' updated successfully.']);
    }

    public function make_inactive_user_types($user_type_id) {
        $title = user_type::where('id', $user_type_id)->value('title');
        user_type::where('id', $user_type_id)->update(['status' => 0]);
        return redirect('view-user-types')->with(['message-warning' => 'User type ' . $title . ' inactivated successfully.']);
    }

    public function make_active_user_types($user_type_id) {
        $title = user_type::where('id', $user_type_id)->value('title');
        user_type::where('id', $user_type_id)->update(['status' => 1]);
        return redirect('view-user-types')->with(['message-info' => 'User type ' . $title . ' activated successfully.']);
    }

    public function delete_user_types($user_type_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = user_type::where('id', $user_type_id)->value('title');
        $old_values = user_type::where('id', $user_type_id)->get();
        $data = array(
            'log_type' => 'User Type deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        user_type::where('id', $user_type_id)->delete();
        return redirect('view-user-types')->with(['message-danger' => 'User type ' . $title . ' deleted successfully.']);
    }

}
