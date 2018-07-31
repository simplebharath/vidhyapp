<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Hash;
use App\User;
use \Input as Input;
use Carbon\Carbon;
use App\User_login;
use App\Http\Controllers\Controller;

class UsersController extends Controller {

    public function add_user() {
        $user_types = \App\User_type::where('id', 1)->get();
        return view('user/add_user', compact('user_types'));
    }

    public function do_add_user(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'first_name' => 'required|alpha_spaces|min:3|max:255',
            'last_name' => 'required|required|alpha_spaces',
            'email_id' => 'required|email|max:255|unique:users',
            'contact_number' => 'required|size:10|regex:/[0-9]{10}/',
            'address' => 'required',
            'user_name' => 'required|min:3|max:255|unique:user_logins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'user_type_id' => 'required'
        ]);
        $token = Hash::make($request['password']);
        $user_logins = new User_login();
        $user_logins->user_name = $request['user_name'];
        $user_logins->password = $request['password'];
        $user_logins->user_type_id = $request['user_type_id'];
        $user_logins->token = $token;
        $user_logins->academic_year_id = $academic_year_id;
        $user_logins->save();
        $results = DB::select(DB::raw("SELECT max(id) as user_login_id FROM user_logins"));
        $user_login_id = $results[0]->user_login_id;
        $users = new User();
        $users->first_name = $request['first_name'];
        $users->last_name = $request['last_name'];
        $users->email_id = $request['email_id'];
        $users->contact_number = $request['contact_number'];
        $users->address = $request['address'];
        $users->user_type_id = $request['user_type_id'];
        $users->add_rights = $request['add_rights'];
        $users->view_rights = $request['view_rights'];
        $users->edit_rights = $request['edit_rights'];
        $users->delete_rights = $request['delete_rights'];
        $users->user_login_id = $user_login_id;
        $users->created_user_id = $created_user_id;
        $users->academic_year_id = $academic_year_id;
        if ($request->hasFile('photo')) {
            $file = Input::file('photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $img = $file->getClientOriginalName();
            $result = array_map('strrev', explode('.', strrev($img)));
            $name = $timestamp . '.' . $result[0];
            $file->move(public_path() . '/uploads/users/', $name);
            $users->photo = $name;
        }
        $data = array(
            'log_type' => ' User added successfully!',
            'message' => 'Added',
            'new_value' => $request['user_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $users->save();
        return redirect('view-user')->with(['message-success' => 'user ' . $request['user_name'] . ' added successfully.']);
    }

    public function view_users() {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('user/view_user', compact('users'));
    }

    public function edit_user($user_id) {
        $users = User::where('id', $user_id)->get();
        $user_types = \App\User_type::where('status', 1)->get();
        return view('user/edit_user', compact('users', 'user_types'));
    }

    public function do_edit_user(Request $request, $user_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'first_name' => 'required|alpha_spaces|min:3|max:255',
            'last_name' => 'required|required|alpha_spaces',
            'email_id' => 'required|email|max:255|unique:users,email_id,' . User::where('id', $user_id)->value('id'),
            'contact_number' => 'required|size:10|regex:/[0-9]{10}/',
            'address' => 'required',
            'user_type_id' => 'required'
        ]);
        $users = User::find($user_id);
        $users->first_name = $request['first_name'];
        $users->last_name = $request['last_name'];
        $users->email_id = $request['email_id'];
        $users->contact_number = $request['contact_number'];
        $users->address = $request['address'];
        $users->user_type_id = $request['user_type_id'];
        $users->add_rights = $request['add_rights'];
        $users->view_rights = $request['view_rights'];
        $users->edit_rights = $request['edit_rights'];
        $users->delete_rights = $request['delete_rights'];
        $users->created_user_id = $created_user_id;
        $users->academic_year_id = $academic_year_id;
        $old_values = User::find($user_id);
        if ($request->hasFile('photo')) {
            $image = $old_values->photo;
            if ($image != '') {
                $image_user = public_path() . '/uploads/users/' . $image;
                if (file_exists($image_user)) {
                    unlink($image_user);
                }
            }
            $file = Input::file('photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
             $img = $file->getClientOriginalName();
            $result = array_map('strrev', explode('.', strrev($img)));
            $name = $timestamp . '.' . $result[0];
            $file->move(public_path() . '/uploads/users/', $name);
            $users->photo = $name;
        }

        $data = array(
            'log_type' => 'User details updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['user_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $users->update();
        return redirect('view-user')->with(['message-success' => 'User ' . $request['user_name'] . ' updated successfully.']);
    }

    public function make_inactive_user($user_id) {
        $user = User::where('id', $user_id)->get();
        User::where('id', $user_id)->update(['status' => 0]);
        User_login::where('id', $user[0]->user_login_id)->update(['status' => 0]);
        return redirect('view-user')->with(['message-warning' => 'User ' . $user[0]->first_name . ' inactivated successfully.']);
    }

    public function make_active_user($user_id) {
        $user = User::where('id', $user_id)->get();
        User::where('id', $user_id)->update(['status' => 1]);
        User_login::where('id', $user[0]->user_login_id)->update(['status' => 1]);
        return redirect('view-user')->with(['message-info' => 'User ' . $user[0]->first_name . ' activated successfully.']);
    }

    public function delete_user($user_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $user = User::where('id', $user_id)->get();
        $old_values = User::where('id', $user_id)->get();
        if ($old_values != '') {
            $image = $old_values[0]->photo;
            if ($image != '') {
                $image_user = public_path() . '/uploads/users/' . $image;
                if (file_exists($image_user)) {
                    unlink($image_user);
                }
            }
        }
        $data = array(
            'log_type' => 'class deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        User::where('id', $user_id)->delete();
        User_login::where('id', $user[0]->user_login_id)->delete();
        return redirect('view-user')->with(['message-danger' => 'User ' . $user[0]->first_name . ' deleted successfully.']);
    }

    public function delete_right_make_no($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['delete_rights' => 0]);
        return redirect('view-user')->with(['message-warning' => 'Activity delete removed for user ' . $first_name . '']);
    }

    public function delete_right_make_yes($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['delete_rights' => 1]);
        return redirect('view-user')->with(['message-info' => 'Activity delete added for user ' . $first_name . '']);
    }

    public function edit_right_make_no($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['edit_rights' => 0]);
        return redirect('view-user')->with(['message-warning' => 'Activity edit removed for user ' . $first_name . '']);
    }

    public function edit_right_make_yes($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['edit_rights' => 1]);
        return redirect('view-user')->with(['message-info' => 'Activity edit added for user ' . $first_name . '']);
    }

    public function view_right_make_no($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['view_rights' => 0]);
        return redirect('view-user')->with(['message-warning' => 'Activity view removed for user ' . $first_name . '']);
    }

    public function view_right_make_yes($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['view_rights' => 1]);
        return redirect('view-user')->with(['message-info' => 'Activity view added for user ' . $first_name . '']);
    }

    public function add_right_make_no($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['add_rights' => 0]);
        return redirect('view-user')->with(['message-warning' => 'Activity add removed for user ' . $first_name . '']);
    }

    public function add_right_make_yes($user_id) {
        $first_name = User::where('id', $user_id)->value('first_name');
        User::where('id', $user_id)->update(['add_rights' => 1]);
        return redirect('view-user')->with(['message-info' => 'Activity add added for user ' . $first_name . '']);
    }

}
