<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Carbon\Carbon;
use App\Institute_detail;
use App\Day;
use \Input as Input;
use App\Http\Controllers\Controller;

class InstituteDetailsController extends Controller {

    public function view_institution_details() {
        $institutions = Institute_detail::limit(1)->get();
        return view('institution_details/institute_profile', compact('institutions'));
    }

    public function view_institution_profile() {
        $institutions = Institute_detail::limit(1)->get();
        return view('institution_details/institute_profile', compact('institutions'));
    }

    public function get_city(Request $request) {
        $state_id = $request->input('data1');
        $cities = DB::select(DB::raw("SELECT * FROM `cities` where state_id=$state_id"));
        return ($cities);
    }

    public function edit_institution_details($institute_details_id) {
        $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE CURRENT_DATE BETWEEN from_date AND to_date AND status=1"));
        $institution = Institute_detail::where('id', $institute_details_id)->get();
        $state_id = $institution[0]->state_id;
        $states = \App\State::where('id', $state_id)->get();
        $cities = \App\City::where('state_id', $state_id)->get();
        $fee_types = \App\Fee_type::get();
        $attendance_types = \App\Attendance_type::get();
        return view('institution_details/edit_institution_details', compact('institution', 'years', 'states', 'cities', 'fee_types', 'attendance_types'));
    }

    public function do_edit_institution_details(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'institution_name' => 'required',
            'institution_email' => 'required|email',
            'registration_number' => 'required',
            'office_contact_number1' => 'required|size:10|regex:/[0-9]{10}/',
            'office_contact_number2' => 'size:10|regex:/[0-9]{10}/',
            'academic_year_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'fee_type_id' => 'required',
            'attendance_type_id' => 'required',
            'established_in' => 'required',
            'affliated_by' => 'required',
            'cp2_name' => 'required|regex:/^[\pL\s\-]+$/u',
            'cp2_email' => 'required|email',
            'cp2_phone1' => 'required|size:10|regex:/[0-9]{10}/',
            'cp2_phone2' => 'size:10|regex:/[0-9]{10}/',
            'mon' => 'required',
            'tue' => 'required',
            'wed' => 'required',
            'thus' => 'required',
            'fri' => 'required',
            'sat' => 'required',
            'sun' => 'required',
        ]);

        Day::where('id', 1)->update(['working_day' => $request['mon']]);
        Day::where('id', 2)->update(['working_day' => $request['tue']]);
        Day::where('id', 3)->update(['working_day' => $request['wed']]);
        Day::where('id', 4)->update(['working_day' => $request['thus']]);
        Day::where('id', 5)->update(['working_day' => $request['fri']]);
        Day::where('id', 6)->update(['working_day' => $request['sat']]);
        Day::where('id', 7)->update(['working_day' => $request['sun']]);
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
            'fee_type_id' => $request->input('fee_type_id'),
            'attendance_type_id' => $request->input('attendance_type_id'),
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
            'mon' => $request['mon'],
            'tue' => $request['tue'],
            'wed' => $request['wed'],
            'thus' => $request['thus'],
            'fri' => $request['fri'],
            'sat' => $request['sat'],
            'sun' => $request['sun'],
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
        return redirect('view-institution-details')->with(['message-success' => 'Institution details updated successfully.']);
    }

}
