<?php

namespace App\Http\Controllers;

use App\Sections as Sections;
Use laravelcollective\html;
use Illuminate\Http\Request;
use Session;
use \App\User_type as User_type;
use \App\Users as Users;
use \App\Classes as Classes;
use \App\Subjects as Subjects;
use \App\Logdetails as Logdetails;
use \App\Academic_Year as Academic_Year;
use App\Http\Requests;
use DB;
use Validator;
use Redirect;
use \Input as Input;
use Auth;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Pagination\Paginator;

class InstituteController extends Controller {

    public function institute_timings_search(Request $request) {
        $query = $request->input('search');
        $timings['timings'] = DB::table('institute_timings')
                ->leftJoin('user_logins', 'institute_timings.created_user_id', '=', 'user_logins.user_login_id')
                ->select('user_logins.user_name', 'institute_timings.active', 'institute_timings.timings_id', 'institute_timings.created_at', 'institute_timings.duration', 'institute_timings.class_end', 'institute_timings.class_start', 'institute_timings.title')
                ->orWhere('institute_timings.timings_id', 'LIKE', '%' . $query . '%')
                ->orWhere('institute_timings.class_start', 'LIKE', '%' . $query . '%')
                ->orWhere('institute_timings.class_end', 'LIKE', '%' . $query . '%')
                ->orWhere('institute_timings.title', 'LIKE', '%' . $query . '%')
                ->orderBy('institute_timings.duration', 'DESC')
                ->paginate(10);
        return view('institutetimings/view_institute_timings', $timings, ['value' => $query]);
    }

    public function view_institute_fee_structure() {
        $fee_classes['fee_classes'] = DB::select(DB::raw("SELECT c.class_name,sections.section_name,MAX(IF(f.fee_title = 'Notebooks', fc.fee_amount, '-')) AS books, MAX(IF(f.fee_title = 'Tuition Fee', fc.fee_amount, '-')) AS tution, MAX(IF(f.fee_title = 'Examination fee', fc.fee_amount, '-')) AS exam FROM classes c LEFT JOIN fee_class fc ON fc.class_id=c.class_id LEFT JOIN fees f ON f.fee_id=fc.fee_id LEFT JOIN sections sections on sections.section_id=fc.section_id GROUP BY fc.class_id,fc.section_id"));
        return view('institutetimings/view_institute_fee_structure', $fee_classes);
    }

    public function add_institute_helpers() {
        return view('institutehelpers/add_institute_helpers');
    }

    public function do_add_institute_helpers(Request $request) {
        $data = Input::except(array('_token'));

        $rule = array(
            'helper_name' => 'required',
            'helper_work' => 'required',
            'helper_contactnumber' => 'required',
            'status' => 'required',
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->hasFile('helper_photo')) {
                $file = Input::file('helper_photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $profile_pic = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/helper/', $profile_pic);


                $data2 = array(
                    'helper_name' => $request->input('helper_name'),
                    'helper_work' => $request->input('helper_work'),
                    'helper_email' => $request->input('helper_email'),
                    'helper_contactnumber' => $request->input('helper_contactnumber'),
                    'helper_address' => $request->input('helper_address'),
                    'helper_photo' => $profile_pic,
                    'status' => $request->input('status'));

                DB::table('institute_helpers')->insert($data2);
                $newvalue = json_encode($data2, true);
                $data1 = array(
                    'log_type' => 'Add Helper details',
                    'message' => ' Added',
                    'new_value' => $newvalue,
                    'old_value' => "No old Value for Add Activity"
                );
                DB::table('log_details')->insert($data1);
                Session::put('add_bus_driver_message', ' Added Successfully !!!');
            } else {

                $data2 = array(
                    'helper_name' => $request->input('helper_name'),
                    'helper_work' => $request->input('helper_work'),
                    'helper_email' => $request->input('helper_email'),
                    'helper_contactnumber' => $request->input('helper_contactnumber'),
                    'helper_address' => $request->input('helper_address'),
                    'status' => $request->input('status'));

                DB::table('institute_helpers')->insert($data2);
                $newvalue = json_encode($data2, true);
                $data1 = array(
                    'log_type' => 'Add Helper details',
                    'message' => ' Added',
                    'new_value' => $newvalue,
                    'old_value' => "No old Value for Add Activity"
                );
                DB::table('log_details')->insert($data1);
                Session::put('add_bus_driver_message', 'Helper Details Added Successfully');

                return redirect('view_institute_helpers');
            }
        }
    }

    public function view_institute_helpers() {
        $helpers['helpers'] = DB::table('institute_helpers')
                ->select('helper_id', 'helper_email', 'helper_photo', 'status', 'helper_contactnumber', 'helper_work', 'helper_address', 'helper_name')
                ->where('status', '=', 1)
                ->orderBy('helper_name', 'ASC')
                ->paginate(20);
        return view('institutehelpers/view_institute_helpers', $helpers);
    }

    public function edit_institute_helpers($id) {
        Session::put('helper_id', $id);
        $helpers['helpers'] = DB::table('institute_helpers')->where('helper_id', $id)->get();
        return view('institutehelpers/edit_institute_helpers', $helpers);
    }

    public function do_edit_institute_helpers(Request $request) {
        $id = Session::get('helper_id');
        $result = DB::table('institute_helpers')->where('helper_id', $id)->get();
        $first_name = $result[0]->helper_name;
        $last_name = $result[0]->helper_work;
        $email = $result[0]->helper_email;
        $address = $result[0]->helper_address;
        $phone = $result[0]->helper_contactnumber;
        ;
        $oldvalue = "first name=" . $first_name . ",work=" . $last_name . ",Email id=" . $email
                . ",address=" . $address . ",contact number=" . $phone;
        $data = Input::except(array('_token'));
        $rule = array(
            'helper_name' => 'required',
            'helper_work' => 'required',
            'helper_contactnumber' => 'required',
            'status' => 'required'
        );
        $validator = Validator::make($data, $rule);
        if ($validator->fails()) {
            return Redirect::back()->withInput($request->input())->withErrors($validator);
        } else {
            if ($request->hasFile('helper_photo')) {
                $file = Input::file('helper_photo');
                $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
                $profile_pic = $timestamp . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/uploads/helper/', $profile_pic);

                $data2 = array(
                    'helper_name' => $request->input('helper_name'),
                    'helper_work' => $request->input('helper_work'),
                    'helper_email' => $request->input('helper_email'),
                    'helper_contactnumber' => $request->input('helper_contactnumber'),
                    'helper_address' => $request->input('helper_address'),
                    'helper_photo' => $profile_pic,
                    'status' => $request->input('status'));
                DB::table('institute_helpers')->where('helper_id', $id)->update($data2);
                $newvalue = json_encode($data2, true);
                $data1 = array(
                    'log_type' => ' Edit Helper details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => $oldvalue,
                    'user_name' => '');
                DB::table('log_details')->insert($data1);
            } else {
                $data4 = array(
                    'helper_name' => $request->input('helper_name'),
                    'helper_work' => $request->input('helper_work'),
                    'helper_email' => $request->input('helper_email'),
                    'helper_contactnumber' => $request->input('helper_contactnumber'),
                    'helper_address' => $request->input('helper_address'),
                    'status' => $request->input('status'));
                DB::table('institute_helpers')->where('helper_id', $id)->update($data4);
                $newvalue = json_encode($data4, true);
                $data5 = array(
                    'log_type' => ' Edit Helper details',
                    'message' => 'Edited',
                    'new_value' => $newvalue,
                    'old_value' => $oldvalue,
                    'user_name' => '');
                DB::table('log_details')->insert($data5);
            }
            Session::put('update_bus_driver_message', 'Updated successfully !!!');
            Session::forget('helper_id');
            return redirect('view_institute_helpers');
        }
    }

    public function delete_institute_helpers($id) {
        $result = DB::table('institute_helpers')->where('helper_id', $id)->get();
        $first_name = $result[0]->helper_name;
        $last_name = $result[0]->helper_work;
        $email = $result[0]->helper_email;
        $address = $result[0]->helper_address;
        $phone = $result[0]->helper_contactnumber;
        ;
        $oldvalue = "first name=" . $first_name . ",work=" . $last_name . ",Email id=" . $email
                . ",address=" . $address . ",contact number=" . $phone;
        $data1 = array(
            'log_type' => 'Delete Helper details',
            'message' => 'Deleted',
            'new_value' => "No New Value for Delete Activity",
            'old_value' => $oldvalue,
            'user_name' => '');
        DB::table('log_details')->insert($data1);
        $helper = DB::table('institute_helpers')->where('helper_id', $id)->update(['status' => 0]);
        if ($helper) {
            Session::put('delete_bus_driver', 'Deleted Successfully !!!');
            return redirect('view_institute_helpers');
        }
    }

    public function search_helpers(Request $request) {
        $query = $request->input('search');
        $helpers['helpers'] = DB::table('institute_helpers')
                        ->where('helper_email', 'LIKE', '%' . $query . '%')
                        ->orWhere('helper_address', 'LIKE', '%' . $query . '%')
                        ->orWhere('helper_contactnumber', 'LIKE', '%' . $query . '%')
                        ->orWhere('helper_work', 'LIKE', '%' . $query . '%')
                        ->orWhere('helper_name', 'LIKE', '%' . $query . '%')
                        ->orderBy('created_at', 'DESC')->paginate(10);

        return view('institutehelpers/view_institute_helpers', $helpers, ['value' => $query]);
    }

}
