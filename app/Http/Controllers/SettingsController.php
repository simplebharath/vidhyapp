<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Institute_detail;
use App\Academic_year;
use App\Validator;
use Session;
use DB;
use Redirect;
use \Input as Input;
use Carbon\Carbon;
use App\Http\Controllers\Controller;

class SettingsController extends Controller {

    public function add_academic_year() {
        $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE CURRENT_DATE BETWEEN from_date AND to_date AND status=1"));
        if (COUNT($years) == 1) {
            return view('settings/add_academic_year', compact('years'));
        } else {
            return view('settings/add_academic_year', compact('years'));
        }
    }

    public function do_add_academic_year(Request $request) {
        $this->validate($request, [
            'from_date' => 'required',
            'to_date' => 'required|after:from_date',
        ]);
        $f_date = $request['from_date'];
        $to_date = $request['to_date'];
        $created_user_id = Session::get('user_login_id');
        $years = new Academic_year();
        $years->from_date = date("Y-m-d", strtotime($f_date));
        $years->to_date = date("Y-m-d", strtotime($to_date));
        $years->created_user_id = $created_user_id;
        $years->save();
        $data = array(
            'log_type' => 'Academic year added successfully!',
            'message' => 'Added',
            'new_value' => $request['from_date'] . '-' . $request['to_date'],
            'old_value' => 'No old values',
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('settings/add-academic-year')->with(['message-success' => 'Academic year details added,please do update acadamic year']);
    }

    public function do_update_academic_year(Request $request) {
        $this->validate($request, [
            'academic_year_id' => 'required',
        ]);
        $a_c_id = request('academic_year_id');
        \App\Institute_detail::where('status', 1)->update(['academic_year_id' => $a_c_id]);
        return redirect('settings/edit-institution-details')->with(['message-success' => 'Academic year details updated,please do verify & update institution details.']);
    }

    public function add_institution_details() {
        $a_c_id = DB::table('settings_check')->where('settings_check_id', '1')->value('academic_year_id');
        $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,academic_year_id FROM academic_years WHERE academic_year_id=$a_c_id"));
        $institutions['states'] = DB::table('state')->get();
        return view('settings/add_institution_details', $institutions, compact('years'));
    }

    public function edit_institution_details() {
        $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE CURRENT_DATE BETWEEN from_date AND to_date AND status=1"));
        $id = $years[0]->id;
        if (COUNT($years) == 1) {
            $institution = \App\Institute_detail::where('academic_year_id', $id)->get();
            $state_id = $institution[0]->state_id;
            $states = \App\State::get();
            $cities = \App\City::where('state_id', $state_id)->get();
            $fee_types = \App\Fee_type::get();
            $attendance_types = \App\Attendance_type::get();
            return view('settings/edit_institution_details', compact('years', 'institution', 'states', 'cities', 'fee_types', 'attendance_types'));
        } else {
            return view('settings/add_academic_year', compact('years'));
        }
    }

    public function getcity(Request $request) {
        $name = $request->input('data1');
        Session::put('classid', $name);
        $cities = DB::select(DB::raw("SELECT * FROM `city` where state_id=$name"));
        return ($cities);
    }

    public function update_institution_details(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'institution_name' => 'required',
            'institution_email' => 'required|email',
            'registration_number' => 'required',
            'office_contact_number1' => 'required|size:10|regex:/[0-9]{10}/',
            'office_contact_number2' => 'size:10|regex:/[0-9]{10}/',
            'academic_year_id' => 'required',
            'attendance_type_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'fee_type_id' => 'required',
            'established_in' => 'required',
            'affliated_by' => 'required',
            'cp2_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'cp2_email' => 'required|email',
            'cp2_phone1' => 'required|size:10|regex:/[0-9]{10}/',
            'cp2_phone2' => 'size:10|regex:/[0-9]{10}/'
        ]);
        $institutions = Institute_detail::find(1);
        $str = $request->input('address');
        $address = str_replace(" ", "", trim($str));
        $data2 = array(
            'institution_name' => $request->input('institution_name'),
            'institution_email' => $request->input('institution_email'),
            'registration_number' => $request->input('registration_number'),
            'office_contact_number1' => $request->input('office_contact_number1'),
            'office_contact_number2' => $request->input('office_contact_number2'),
            'academic_year_id' => $request->input('academic_year_id'),
            'attendance_type_id' => $request->input('attendance_type_id'),
            'fee_type_id' => $request->input('fee_type_id'),
            'state_id' => $request->input('state_id'),
            'city_id' => $request->input('city_id'),
            'address' => $address,
            'tag_line' => $request->input('tag_line'),
            'youtube_channel' => $request->input('youtube_channel'),
            'established_in' => $request->input('established_in'),
            'affliated_by' => $request->input('affliated_by'),
            'cp2_name' => $request->input('cp2_name'),
            'cp2_email' => $request->input('cp2_email'),
            'cp2_phone1' => $request->input('cp2_phone1'),
            'cp2_phone2' => $request->input('cp2_phone2'),
            'created_user_id' => $created_user_id);
        if ($request->hasFile('institution_image')) {
            $image = $institutions->institution_image;
            if ($image != '') {
                $institution_images = public_path() . '/uploads/logo/' . $image;
                if (file_exists($institution_images)) {
                    unlink($institution_images);
                }
            }
            $file = Input::file('institution_image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $institution_image = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/logo/', $institution_image);
            $data2['institution_image'] = $institution_image;
        }
        if ($request->hasFile('institution_logo')) {
            $image = $institutions->institution_logo;
            if ($image != '') {
                $institution_logos = public_path() . '/uploads/logo/' . $image;
                if (file_exists($institution_logos)) {
                    unlink($institution_logos);
                }
            }
            $file = Input::file('institution_logo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $institution_logo = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/logo/', $institution_logo);
            $data2['institution_logo'] = $institution_logo;
        }
        $institutions->fill($data2);
        $institutions->update();
        $comma_separated = implode(",", $data2);
        $data1 = array(
            'log_type' => 'settings Add Institution details',
            'message' => 'first time institute_details',
            'new_value' => "No New Value for Add Activity",
            'old_value' => $comma_separated,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data1);
        Session::forget('Not_A_user');
        return redirect('admin-dashboard');
    }

    public function do_add_institution_details(Request $request) {
        $data = Input::except(array('_token'));
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $createduserid = Session::get('user_login_id');
        $rule = array(
            'institution_name' => 'required',
            'institution_email' => 'required|email|max:255',
            'registration_number' => 'required',
            'office_contact_number1' => 'required|numeric',
            'office_contact_number2' => 'numeric',
            'academic_year' => 'required',
            'institution_logo' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'cp1_name' => 'required|alpha',
            'cp1_email' => 'required|email',
            'cp1_phone1' => 'required|numeric',
            'cp1_phone2' => 'numeric',
            'cp2_name' => 'required|alpha',
            'cp2_email' => 'required|email',
            'cp2_phone1' => 'required|numeric',
            'cp2_phone2' => 'numeric');
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->hasFile('institution_logo')) {
                $file = Input::file('institution_logo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_logo = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $institution_logo);
            }
            if ($request->hasFile('institution_image')) {
                $file = Input::file('institution_image');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $institution_image = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/', $institution_image);
            }
            $str = $request->input('address');
            $address = str_replace(" ", "", trim($str));
            $data2 = array(
                'institution_name' => $request->input('institution_name'),
                'institution_email' => $request->input('institution_email'),
                'registration_number' => $request->input('registration_number'),
                'office_contact_number1' => $request->input('office_contact_number1'),
                'office_contact_number2' => $request->input('office_contact_number2'),
                'academic_year_id' => $request->input('academic_year'),
                'institution_logo' => $institution_logo,
                'institution_image' => $institution_image,
                'state_id' => $request->input('state'),
                'city_id' => $request->input('city'),
                'address' => $address,
                'cp1_name' => $request->input('cp1_name'),
                'cp1_email' => $request->input('cp1_email'),
                'cp1_phone1' => $request->input('cp1_phone1'),
                'cp1_phone2' => $request->input('cp1_phone2'),
                'cp2_name' => $request->input('cp2_name'),
                'cp2_email' => $request->input('cp2_email'),
                'cp2_phone1' => $request->input('cp2_phone1'),
                'cp2_phone2' => $request->input('cp2_phone2'),
                'created_user_id' => $createduserid);
            $comma_separated = implode(",", $data2);
            DB::table('institute_details')->insert($data2);
            $data1 = array(
                'log_type' => 'settings Add Institution details',
                'message' => 'first time institute_details',
                'new_value' => "No New Value for Add Activity",
                'old_value' => $comma_separated,
                'user_name' => $createduserid);
            DB::table('log_details')->insert($data1);

            DB::table('settings_check')
                    ->where('settings_check_id', 1)
                    ->limit(1)
                    ->update(array('acadamic_year_id' => $request->input('academic_year'), 'set_institute_details' => '1', 'updated_user_id' => $createduserid, 'updated_at' => $current_time));
            Session::forget('Not_A_user');
            return redirect('dashboard');
        }
    }

    public function add_fee_types() {
        return view('settings/add_fee_types');
    }

    public function do_add_fee_types(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $current_time = \Carbon\Carbon::now()->toDateTimeString();

        $rule = array(
            'fee_name' => 'required|alpha_spaces|unique:fee_types',
            'fee_status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            $fee_name = $request->input('fee_name');
            $fee_status = $request->input('fee_status');
            $data1 = array(
                'fee_name' => $request->input('fee_name'),
                'fee_status' => $request->input('fee_status'),
                'created_user_id' => $id);
            DB::table('fee_types')->insert($data1);
            $newvalue = "Their is No NewValue value for Add";
            $oldvalue = "fee_name=$fee_name,status=$fee_status,created_user_id=$id,created_at=$current_time";
            $data1 = array(
                'log_type' => 'Add Fee Types',
                'message' => 'fee_types',
                'new_value' => $newvalue,
                'old_value' => $oldvalue,
                'user_name' => $id);
            DB::table('log_details')->insert($data1);
            DB::table('settings_check')
                    ->where('settings_check_id', 1)
                    ->limit(1)
                    ->update(array('acadamic_year_id' => '1', 'set_institute_details' => '1', 'set_fee_details' => '1', 'updated_user_id' => $id, 'updated_at' => $current_time));
            Session::forget('Not_A_user');
            return redirect('dashboard');
        }
    }

    public function attendance_settings() {
        $attendance_types['attendance_types'] = DB::table('attendance_type')->get();
        $attendance_types['attendance_settings'] = DB::table('attendance_settings')
                ->leftJoin('attendance_type', 'attendance_type.attendance_type_id', '=', 'attendance_settings.attendance_type_id')
                ->select('attendance_type.attendance_type_id', 'attendance_type.attendance_type_title')
                ->limit(1)
                ->get();
        return view('settings/attendace_settings', $attendance_types);
    }

    public function do_attendance_settings(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        if ($request->input('attendance_type') != '') {
            $rule = array(
                'attendance_type' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::back()->withInput($request->input())->withErrors($validator);
            } else {
                $data1 = array(
                    'attendance_type_id' => $request->input('attendance_type'),
                    'academic_year_id' => $academic_year_id,
                    'created_user_id' => $id);
                DB::table('attendance_settings')->insert($data1);
                Session::put('attendance_settings', 'attendance settings are updated Successfully.');
            }
        } else {
            $rule = array(
                'attendance_type_edit' => 'required'
            );
            $validator = Validator::make($data, $rule);
            if ($validator->fails()) {
                return Redirect::back()->withInput($request->input())->withErrors($validator);
            } else {
                $attendance_type_id = $request->input('attendance_type_edit');
                $data1 = array(
                    'attendance_type_id' => $request->input('attendance_type_edit'),
                    'updated_user_id' => $id);
                DB::table('attendance_settings')->where('attendance_type_id', $attendance_type_id)->update($data1);
                Session::put('attendance_settings', 'attendance settings are updated Successfully.');
            }
        }
        return redirect('dashboard');
    }

    public function grade_settings() {
        $grade['percentages'] = DB::table('percentage')->get();
        $grade['grades'] = DB::table('grade')->get();
        return view('settings/grade_settings', $grade);
    }

    public function do_grade_settings(Request $request) {
        $id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $data = Input::except(array('_token'));
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $rule = array(
            'percentage_id' => 'required',
            'grade_id' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            $string = $request->input('percentage_id');
            $grades = explode('-', $string);
            $grade_from = $grades[0];
            $grade_to = $grades[1];
            $data1 = array(
                'grade_id' => $request->input('grade_id'),
                'percentage_from' => $grade_from,
                'percentage_to' => $grade_to,
                'academic_year_id' => $academic_year_id,
                'created_user_id' => $id);
            DB::table('grade_settings')->insert($data1);
            Session::put('grade_settings', 'Grade settings are updated Successfully.');
            return redirect('dashboard');
        }
    }

    public function password_settings() {
        $password_settings['students'] = DB::table('students')
                ->leftJoin('user_logins', 'students.user_login_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'students.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'students.section_id')
                ->leftJoin('parents', 'parents.student_id', '=', 'students.student_id')
                ->leftJoin('academic_years', 'academic_years.academic_year_id', '=', 'students.academic_year')
                ->select('students.student_id', 'classes.class_name', 'students.class_id', 'students.admission_number', 'parents.first_name as parent_first_name', 'parents.last_name as parent_last_name', 'parents.profile_pic as parent_pic', 'students.section_id', 'sections.section_name', 'students.created_user_id', 'students.updated_user_id', 'students.created_at', 'students.updated_at', 'user_logins.user_name', 'user_logins.password', 'students.academic_year', 'students.roll_number', 'students.first_name', 'students.last_name', 'students.profile_pic', 'students.contact_number', 'students.emergency_number')
                ->where('students.active', 1)
                ->paginate(20);
        return view('settings/student_password_settings', $password_settings);
    }

    public function student_credentials_change($id) {
        $password_settings['students'] = DB::table('students')
                ->leftJoin('user_logins', 'students.user_login_id', '=', 'user_logins.user_login_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'students.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'students.section_id')
                ->leftJoin('parents', 'parents.student_id', '=', 'students.student_id')
                ->leftJoin('academic_years', 'academic_years.academic_year_id', '=', 'students.academic_year')
                ->select('students.student_id', 'students.user_login_id', 'classes.class_name', 'students.class_id', 'students.admission_number', 'parents.first_name as parent_first_name', 'parents.last_name as parent_last_name', 'parents.profile_pic as parent_pic', 'students.section_id', 'sections.section_name', 'students.created_user_id', 'students.updated_user_id', 'students.created_at', 'students.updated_at', 'user_logins.user_name', 'user_logins.password', 'students.academic_year', 'students.roll_number', 'students.first_name', 'students.last_name', 'students.profile_pic', 'students.contact_number', 'students.emergency_number')
                ->where('students.student_id', $id)
                ->get();
        return view('settings/student_credentials_change', $password_settings);
    }

    public function student_credentials_change_submit(Request $request, $id) {
        $data = Input::except(array('_token'));
        $rule = array(
            'user_name' => 'min:3',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $new_password = $request->input('password');
            $user_name = $request->input('user_name');
            DB::table('user_logins')
                    ->where('user_login_id', $id)
                    ->limit(1)
                    ->update(array('password' => $new_password, 'user_name' => $user_name));
            Session::put('student_password_change', 'Student Credentials Updated Successfully');
            return redirect('password_settings');
        }
    }

    public function parent_credentials_list() {
        $parents['parents'] = DB::table('parents')
                ->leftJoin('user_logins', 'parents.created_user_id', '=', 'user_logins.user_login_id')
                ->leftJoin('students', 'students.student_id', '=', 'parents.student_id')
                ->leftJoin('classes', 'classes.class_id', '=', 'students.class_id')
                ->leftJoin('sections', 'sections.section_id', '=', 'students.section_id')
                ->select('students.student_id', 'parents.user_login_id', 'classes.class_name', 'classes.class_id', 'sections.section_id', 'sections.section_name', 'students.first_name as student_first_name', 'students.last_name as student_last_name', 'students.profile_pic as student_profile_pic', 'students.admission_number', 'students.roll_number', 'parents.parent_id', 'parents.first_name', 'parents.email_id', 'parents.address', 'parents.last_name', 'parents.created_user_id', 'parents.updated_user_id', 'parents.created_at', 'parents.updated_at', 'user_logins.user_name', 'parents.profile_pic', 'parents.contact_number', 'parents.emergency_number')
                ->where('parents.active', 1)
                ->paginate(20);
        return view('settings/parents_credentials_list', $parents);
    }

    public function parent_credentials_change($parent_id) {
        $parents['parents'] = DB::table('parents')
                ->leftJoin('user_logins', 'parents.user_login_id', '=', 'user_logins.user_login_id')
                ->select('parents.parent_id', 'user_logins.user_name', 'user_logins.password', 'user_logins.user_login_id')
                ->where('parents.parent_id', $parent_id)
                ->paginate(20);
        return view('settings/parent_credentials_change', $parents);
    }

    public function parent_credentials_change_submit($user_login_id, Request $request) {
        $data = Input::except(array('_token'));
        $rule = array(
            'user_name' => 'min:3',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $new_password = $request->input('password');
            $user_name = $request->input('user_name');
            DB::table('user_logins')
                    ->where('user_login_id', $user_login_id)
                    ->limit(1)
                    ->update(array('password' => $new_password, 'user_name' => $user_name));
            Session::put('parent_password_change', 'Parent Credentials Updated Successfully');
            return redirect('parent_credentials_list');
        }
    }

    public function staff_credentials_list() {
        $staffs['staffs'] = DB::table('staff')
                ->join('user_logins', 'staff.created_user_id', '=', 'user_logins.user_login_id')
                ->select('staff.staff_id', 'staff.staff_type_id', 'staff.emp_department', 'user_logins.user_name', 'staff.first_name', 'staff.created_user_id', 'staff.last_name', 'staff.email', 'staff.contact_number', 'staff.profile_pic', 'staff.created_at', 'staff.updated_at')
                ->where('staff.active', 1)
                ->orderBy('staff.first_name', 'ASC')
                ->paginate(20);
        return view('settings/staff_credentials_list', $staffs);
    }

    public function staff_credentials_change($staff_id) {
        $staffs['staffs'] = DB::table('staff')
                ->join('user_logins', 'staff.user_login_id', '=', 'user_logins.user_login_id')
                ->select('staff.staff_id', 'user_logins.user_name', 'user_logins.password', 'user_logins.user_login_id')
                ->where('staff.staff_id', $staff_id)
                ->get();
        return view('settings/staff_credentials_change', $staffs);
    }

    public function staff_credentials_change_submit($user_login_id, Request $request) {
        $data = Input::except(array('_token'));
        $rule = array(
            'user_name' => 'min:3',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $new_password = $request->input('password');
            $user_name = $request->input('user_name');
            DB::table('user_logins')
                    ->where('user_login_id', $user_login_id)
                    ->limit(1)
                    ->update(array('password' => $new_password, 'user_name' => $user_name));
            Session::put('staff_password_change', 'Staff Credentials Updated Successfully');
            return redirect('staff_credentials_list');
        }
    }

    public function system_admin_credentials_list() {
        $users['users'] = DB::table('users')
                        ->select('users.first_name', 'users.last_name', 'users.user_id', 'users.email_id', 'users.contact_number', 'users.photo', 'users.user_id')
                        ->where('users.user_type_id', 2)
                        ->where('users.active', 1)->get();
        return view('settings/system_admin_credentials_list', $users);
    }

    public function system_admin_credentials_change($user_id) {
        $users['users'] = DB::table('users')
                ->leftJoin('user_logins', 'user_logins.user_login_id', '=', 'users.user_login_id')
                ->select('user_logins.user_name', 'user_logins.password', 'user_logins.user_login_id', 'users.user_id')
                ->where('users.user_id', $user_id)
                ->get();
        return view('settings/system_admin_credentials_change', $users);
    }

    public function system_admin_credentials_change_submit($user_login_id, Request $request) {
        $data = Input::except(array('_token'));
        $rule = array(
            'user_name' => 'min:3',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $new_password = $request->input('password');
            $user_name = $request->input('user_name');
            DB::table('user_logins')
                    ->where('user_login_id', $user_login_id)
                    ->limit(1)
                    ->update(array('password' => $new_password, 'user_name' => $user_name));
            Session::put('system_admin_password_change', 'System Admin Credentials Updated Successfully');
            return redirect('system_admin_credentials_list');
        }
    }

    public function clerk_credentials_list() {
        $users['users'] = DB::table('users')
                ->select('users.first_name', 'users.last_name', 'users.email_id', 'users.contact_number', 'users.photo', 'users.user_id')
                ->where('users.user_type_id', 3)
                ->where('users.active', 1)
                ->get();
        return view('settings/clerk_credentials_list', $users);
    }

    public function clerk_credentials_change($user_id) {
        $users['users'] = DB::table('users')
                ->leftJoin('user_logins', 'user_logins.user_login_id', '=', 'users.user_login_id')
                ->select('user_logins.user_name', 'user_logins.password', 'user_logins.user_login_id', 'users.user_id')
                ->where('users.user_id', $user_id)
                ->get();
        return view('settings/clerk_credentials_change', $users);
    }

    public function clerk_credentials_change_submit($user_login_id, Request $request) {
        $data = Input::except(array('_token'));
        $rule = array(
            'user_name' => 'min:3',
            'password' => 'min:6|confirmed',
            'password_confirmation' => 'min:6'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator);
        } else {
            $new_password = $request->input('password');
            $user_name = $request->input('user_name');
            DB::table('user_logins')
                    ->where('user_login_id', $user_login_id)
                    ->limit(1)
                    ->update(array('password' => $new_password, 'user_name' => $user_name));
            Session::put('clerk_password_change', 'Clerk Credentials Updated Successfully');
            return redirect('clerk_credentials_list');
        }
    }

}
