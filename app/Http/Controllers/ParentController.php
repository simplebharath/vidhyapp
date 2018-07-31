<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Hash;
use App\Parent_detail;
use Carbon\Carbon;
use \Input as Input;
use App\Http\Controllers\Controller;

class ParentController extends Controller {

    public function add_parent($student_id) {
        $add = Session::get('add');
        $academic_year_id = Session::get('academic_year_id');
        if ($add == 1) {
            $id = \App\Student::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->value('id');
            $parent = Parent_detail::where('student_id', $id)->get();
            if (COUNT($parent) == 1) {
                $s_id = \App\Parent_detail::where('parent_id', $parent[0]->parent_id)->where('academic_year_id', $academic_year_id)->value('id');

                return redirect('edit-parent/' . $s_id)->with(['message-success' => 'Student ' .  $parent[0]->students->first_name. ' updated successfully.']);
            }
            $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE id = $academic_year_id AND status=1"));
            $user_types = \App\User_type::where('id', 7)->get();
            $student = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
            return view('parent_details/add_parent', compact('years', 'user_types', 'student'));
        } else {
            return redirect('view-parents');
        }
    }

    public function view_parents() {
        $academic_year_id = Session::get('academic_year_id');
        $parents = Parent_detail::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('parent_details/view_parents', compact('parents'));
    }

    public function do_add_parent(Request $request, $student_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'academic_year_id' => 'required',
            'user_type_id' => 'required',
            'mother_name' => 'required|min:3|max:255',
            'father_name' => 'required|min:3|max:255',
            'mother_email' => 'email|max:255',
            'father_email' => 'email|max:255',
            'father_number' => 'required|size:10|regex:/[0-9]{10}/',
            'mother_number' => 'size:10|regex:/[0-9]{10}/',
            'user_name' => 'required|min:3|max:255|unique:user_logins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'father_occupation' => 'required',
            'family_income' => 'required',
            'mother_photo' => 'mimes:jpeg,bmp,png',
            'father_photo' => 'mimes:jpeg,bmp,png',
        ]);
        $token = Hash::make($request['password']);
        $user_logins = new \App\User_login();
        $user_logins->user_name = $request['user_name'];
        $user_logins->password = $request['password'];
        $user_logins->user_type_id = $request['user_type_id'];
        $user_logins->token = $token;
        $user_logins->academic_year_id = $academic_year_id;
        $user_logins->save();
        $results = DB::select(DB::raw("SELECT max(id) as user_login_id FROM user_logins"));
        $user_login_id = $results[0]->user_login_id;

        $parent_ids = DB::select(DB::raw("SELECT max(id) as parent_id FROM parent_details"));
        if ($parent_ids != ''):
            $parent_id = $parent_ids[0]->parent_id;
        else:
            $parent_id = 0;
        endif;
        $p = $parent_id + 1;
        $parent = new Parent_detail();
        $parent->student_id = $student_id;
        $parent->parent_id = $p;
        $parent->user_type_id = $request['user_type_id'];
        $parent->mother_name = $request['mother_name'];
        $parent->mother_email = $request['mother_email'];
        $parent->mother_number = $request['mother_number'];
        $parent->mother_education = $request['mother_education'];
        $parent->mother_occupation = $request['mother_occupation'];
        $parent->father_name = $request['father_name'];
        $parent->father_email = $request['father_email'];
        $parent->father_number = $request['father_number'];
        $parent->father_education = $request['father_education'];
        $parent->father_occupation = $request['father_occupation'];
        $parent->family_income = $request['family_income'];
        $parent->address = $request['address'];
        $parent->user_login_id = $user_login_id;
        $parent->created_user_id = $created_user_id;
        $parent->academic_year_id = $academic_year_id;
        $parent->user_type_id = $request['user_type_id'];
        if ($request->hasFile('mother_photo')) {
            $file = Input::file('mother_photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp;
            $file->move(public_path() . '/uploads/students/mother/', $name);
            $parent->mother_photo = $name;
        }
        if ($request->hasFile('father_photo')) {
            $file = Input::file('father_photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp;
            $file->move(public_path() . '/uploads/students/father/', $name);
            $parent->father_photo = $name;
        }
        $parent->save();

        $data = array(
            'log_type' => ' Parent added successfully!',
            'message' => 'Added',
            'new_value' => $request['user_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $student_id = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('student_id');
        return redirect('add-student-education/' . $student_id)->with(['message-success' => 'Parent ' . $request['user_name'] . ' added successfully.Please do add previous education details']);
    }

    public function edit_parent($parent_id) {
        $parent = Parent_detail::where('id', $parent_id)->get();
        if (COUNT($parent) != 1) {
            return redirect('add-student');
        }
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $id = Parent_detail::where('parent_id', $parent_id)->where('academic_year_id', $academic_year_id)->value('id');
            $parents = Parent_detail::where('id', $id)->orwhere('id', $parent_id)->get();
            $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE id = $academic_year_id AND to_date AND status=1"));
            $user_types = \App\User_type::where('id', 7)->get();
            return view('parent_details/edit_parent', compact('years', 'user_types', 'parents'));
        } else {
            return redirect('view-parents');
        }
    }

    public function do_edit_parent(Request $request, $parent_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'academic_year_id' => 'required',
            'user_type_id' => 'required',
            'mother_name' => 'required|min:3|max:255',
            'father_name' => 'required|min:3|max:255',
            'mother_email' => 'email|max:255',
            'father_email' => 'email|max:255',
            'father_number' => 'required|size:10|regex:/[0-9]{10}/',
            'mother_number' => 'size:10|regex:/[0-9]{10}/',
            'father_occupation' => 'required',
            'family_income' => 'required',
            'mother_photo' => 'mimes:jpeg,bmp,png',
            'father_photo' => 'mimes:jpeg,bmp,png',
        ]);

        $parent = Parent_detail::find($parent_id);
        $parent->user_type_id = $request['user_type_id'];
        $parent->mother_name = $request['mother_name'];
        $parent->mother_email = $request['mother_email'];
        $parent->mother_number = $request['mother_number'];
        $parent->mother_education = $request['mother_education'];
        $parent->mother_occupation = $request['mother_occupation'];
        $parent->father_name = $request['father_name'];
        $parent->father_email = $request['father_email'];
        $parent->father_number = $request['father_number'];
        $parent->father_education = $request['father_education'];
        $parent->father_occupation = $request['father_occupation'];
        $parent->family_income = $request['family_income'];
        $parent->address = $request['address'];
        $parent->updated_user_id = $created_user_id;
        //$parent->academic_year_id = $academic_year_id;
        $parent->user_type_id = $request['user_type_id'];
        $old_values = Parent_detail::find($parent_id);
        if ($request->hasFile('mother_photo')) {
            $image = $old_values->mother_photo;
            if ($image != '') {
                $image_parent = public_path() . '/uploads/students/mother/' . $image;
                if (file_exists($image_parent)) {
                    unlink($image_parent);
                }
            }
            $file = Input::file('mother_photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp;
            $file->move(public_path() . '/uploads/students/mother/', $name);
            $parent->mother_photo = $name;
        }
        if ($request->hasFile('father_photo')) {
            $image = $old_values->father_photo;
            if ($image != '') {
                $image_parent = public_path() . '/uploads/students/father/' . $image;
                if (file_exists($image_parent)) {
                    unlink($image_parent);
                }
            }
            $file = Input::file('father_photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp;
            $file->move(public_path() . '/uploads/students/father/', $name);
            $parent->father_photo = $name;
        }

        $data = array(
            'log_type' => 'Parent details updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['father_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $parent->update();
        $studen_id = Parent_detail::where('id', $parent_id)->where('academic_year_id', $academic_year_id)->value('student_id');
        return redirect('add-student-education/' . $studen_id)->with(['message-success' => 'Parent ' . $request['father_name'] . ' updated successfully.']);
    }

    public function make_inactive_parent($parent_id) {
        $parent = Parent_detail::where('id', $parent_id)->get();
        Parent_detail::where('id', $parent_id)->update(['status' => 0]);
        \App\User_login::where('id', $parent[0]->user_login_id)->update(['status' => 0]);
        return redirect('view-parents')->with(['message-warning' => 'User ' . $parent[0]->first_name . ' inactivated successfully.']);
    }

    public function make_active_parent($parent_id) {
        $parent = Parent_detail::where('id', $parent_id)->get();
        Parent_detail::where('id', $parent_id)->update(['status' => 1]);
        \App\User_login::where('id', $parent[0]->user_login_id)->update(['status' => 1]);
        return redirect('view-parents')->with(['message-info' => 'User ' . $parent[0]->first_name . ' activated successfully.']);
    }

    public function delete_parent($parent_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $parent = Parent_detail::where('id', $parent_id)->get();
        $old_values = Parent_detail::where('id', $parent_id)->get();
        if (COUNT($old_values) == 1) {
            $image = $old_values->photo;
            if ($image != '') {
                $image_user = public_path() . '/uploads/parent/' . $image;
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
        Parent_detail::where('id', $parent_id)->delete();
        \App\User_login::where('id', $parent[0]->user_login_id)->delete();
        return redirect('view-parents')->with(['message-danger' => 'User ' . $parent[0]->first_name . ' deleted successfully.']);
    }

    public function parent_delete_right_make_no($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['delete_rights' => 0]);
        return redirect('view-parents')->with(['message-warning' => 'Activity delete removed for parent ' . $first_name . '']);
    }

    public function parent_delete_right_make_yes($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['delete_rights' => 1]);
        return redirect('view-parents')->with(['message-info' => 'Activity delete added for parent ' . $first_name . '']);
    }

    public function parent_edit_right_make_no($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['edit_rights' => 0]);
        return redirect('view-parents')->with(['message-warning' => 'Activity edit removed for parent ' . $first_name . '']);
    }

    public function parent_edit_right_make_yes($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['edit_rights' => 1]);
        return redirect('view-parents')->with(['message-info' => 'Activity edit added for parent ' . $first_name . '']);
    }

    public function parent_view_right_make_no($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['view_rights' => 0]);
        return redirect('view-parents')->with(['message-warning' => 'Activity view removed for parent ' . $first_name . '']);
    }

    public function parent_view_right_make_yes($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['view_rights' => 1]);
        return redirect('view-parents')->with(['message-info' => 'Activity view added for parent ' . $first_name . '']);
    }

    public function parent_add_right_make_no($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['add_rights' => 0]);
        return redirect('view-parents')->with(['message-warning' => 'Activity add removed for parent ' . $first_name . '']);
    }

    public function parent_add_right_make_yes($parent_id) {
        $first_name = Parent_detail::where('id', $parent_id)->value('first_name');
        Parent_detail::where('id', $parent_id)->update(['add_rights' => 1]);
        return redirect('view-parents')->with(['message-info' => 'Activity add added for parent ' . $first_name . '']);
    }

}
