<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use Mail;
use Hash;
use Carbon\Carbon;
use \Input as Input;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Controllers\Controller;

class StaffController extends Controller {

    public function add_staff() {
        $add = Session::get('add');
        if ($add == 1) {
            $id = Session::get('academic_year_id');
            $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years WHERE id = $id"));
            $staff_types = \App\Staff_type::where('status', '1')->get();
            $user_types = \App\User_type::where('status', '1')->where('id','!=',1)->get();
            return view('staff_details/add_staff', compact('years', 'staff_types', 'user_types'));
        } else {
            return redirect('view-staff');
        }
    }

    public function get_department(Request $request) {
        $staff_type_id = $request->input('staff_type_id');
        $staff_departments = DB::select(DB::raw("SELECT * FROM `staff_departments` where staff_type_id=$staff_type_id"));
        return ($staff_departments);
    }

    public function view_staff() {
        $academic_year_id = Session::get('academic_year_id');
        $staffs = \App\Staff::where('academic_year_id', $academic_year_id)->get();
        return view('staff_details/view_staff', compact('staffs'));
    }

    public function view_staff_profile($staff_id) {
        if (Session::has('staff_id')) {
            if (Session::has('staff_id') == $staff_id) {
                return redirect('view-staff-profile');
            }
        }
        $staffs = \App\Staff::where('id', $staff_id)->get();
        if (COUNT($staffs) == 1) {
            $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
            $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
            if ($classes != ''):
                $no_classes = $classes[0]->subjects;
            else:
                $no_classes = 0;
            endif;
            return view('staff_details/staff_profile', compact('staffs', 'institute_details', 'no_classes'));
        }else {
            return redirect('admin-login');
        }
    }

    public function view_staff_prof() {
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
            $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
            $staffs = \App\Staff::where('id', $staff_id)->get();
            if (COUNT($staffs) == 1) {
                $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
                if ($classes != ''):
                    $no_classes = $classes[0]->subjects;
                else:
                    $no_classes = 0;
                endif;
                return view('staff_details/staff_profile', compact('staffs', 'institute_details', 'no_classes'));
            }
        }else {
            return redirect('admin-login');
        }
    }

    public function do_add_staff(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_ids = \App\Institute_detail::where('status', '1')->get();
        $academic_year_id = Session::get('academic_year_id');
        $institute_code = $academic_year_ids[0]->institution_code;
        $staff_ids = DB::select(DB::raw("SELECT max(id) as staff_id FROM staff"));
        if ($staff_ids != ''):
            $staff_id = $staff_ids[0]->staff_id;
        else:
            $staff_id = 0;
        endif;
        $new_staff_id = $staff_id + 1001;
        $join = [$institute_code, 'E', $new_staff_id];
        $staff_unique_id = implode("-", $join);
        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255|unique:staff',
            'contact_number' => 'required|size:10|regex:/[0-9]{10}/',
            'emergency_number' => 'size:10|regex:/[0-9]{10}/',
            'user_name' => 'required|min:3|max:255|unique:user_logins',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6',
            'user_type_id' => 'required',
            'date_of_birth' => 'required',
            'joined_date' => 'required',
            'experience' => 'required',
            'employee_id' => 'required',
            'staff_department_id' => 'required',
            'staff_type_id' => 'required',
            'photo' => 'mimes:jpeg,bmp,png',
            'emergency_number' => 'required',
            'basic_salary' => 'required',
            'total_salary' => 'required',
            'father_name' => 'required',
            'present_address' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'nationality' => 'required',
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

        $stafff_ids = DB::select(DB::raw("SELECT max(id) as staff_ids FROM staff"));
        if ($stafff_ids != ''):
            $stff_id = $stafff_ids[0]->staff_ids;
        else:
            $stff_id = 0;
        endif;
        $st = $stff_id + 1;

        $staff = new \App\Staff();
        $staff->staff_id = $st;
        $staff->first_name = $request['first_name'];
        $staff->middle_name = $request['middle_name'];
        $staff->last_name = $request['last_name'];
        $staff->email = $request['email'];
        $staff->experience = $request['experience'];
        $staff->contact_number = $request['contact_number'];
        $staff->emergency_number = $request['emergency_number'];
        $staff->date_of_birth = $request['date_of_birth'];
        $staff->joined_date = $request['joined_date'];
        $staff->staff_type_id = $request['staff_type_id'];
        $staff->staff_department_id = $request['staff_department_id'];
        $staff->employee_id = $request['employee_id'];
        $staff->emp_designation = $request['emp_designation'];
        $staff->add_rights = $request['add_rights'];
        $staff->view_rights = $request['view_rights'];
        $staff->edit_rights = $request['edit_rights'];
        $staff->delete_rights = $request['delete_rights'];
        $staff->basic_salary = $request['basic_salary'];
        $staff->incentives = $request['incentives'];
        $staff->other_salary = $request['other_salary'];
        $staff->salary_cuttings = $request['salary_cuttings'];
        $staff->total_salary = $request['total_salary'];
        $staff->aadhaar_number = $request['aadhaar_number'];
        $staff->father_number = $request['father_number'];
        $staff->father_name = $request['father_name'];
        $staff->present_address = $request['present_address'];
        $staff->permanent_address = $request['permanent_address'];
        $staff->gender = $request['gender'];
        $staff->blood_group = $request['blood_group'];
        $staff->religion = $request['religion'];
        $staff->nationality = $request['nationality'];
        $staff->caste = $request['caste'];
        $staff->marital_status = $request['marital_status'];
        $staff->spouse_name = $request['spouse_name'];
        $staff->occupation = $request['occupation'];
        $staff->child_number = $request['child_number'];
        $staff->domicile = $request['domicile'];
        $staff->staff_unique_id = $staff_unique_id;
        $staff->user_login_id = $user_login_id;
        $staff->created_user_id = $created_user_id;
        $staff->academic_year_id = $academic_year_id;
        $staff->user_type_id = $request['user_type_id'];
        if ($request->hasFile('photo')) {
            $file = Input::file('photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $img = $file->getClientOriginalName();
            $result = array_map('strrev', explode('.', strrev($img)));
            $name = $timestamp . '.' . $result[0];
            $file->move(public_path() . '/uploads/staff/', $name);
            $staff->photo = $name;
        }
        $staff->save();

        $data = array(
            'log_type' => ' Staff added successfully!',
            'message' => 'Added',
            'new_value' => $request['user_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff_id = \App\Staff::where('user_login_id', $user_login_id)->value('id');
        return redirect('add-staff-qualification/' . $staff_id)->with(['message-success' => 'user ' . $request['user_name'] . ' added successfully.Please do add educational qualifications']);
    }

    public function edit_staff($staff_id) {
        $staff = \App\Staff::where('id', $staff_id)->get();
        if (COUNT($staff) != 1) {
            return redirect('add-staff');
        }
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $staff = \App\Staff::where('id', $staff_id)->get();
            $staff_type_id = $staff[0]->staff_type_id;
            $years = DB::select(DB::raw("SELECT DATE_FORMAT(from_date,'%Y') AS from_year,DATE_FORMAT(to_date,'%Y') AS to_year,id FROM academic_years"));
            $staff_types = \App\Staff_type::where('id', $staff_type_id)->get();
            $user_types = \App\User_type::where('status', '1')->get();
            $staff_departments = \App\Staff_department::where('staff_type_id', $staff_type_id)->where('status', 1)->get();
            return view('staff_details/edit_staff', compact('years', 'staff_types', 'user_types', 'staff_departments', 'staff'));
        } else {
            return redirect('view-staff');
        }
    }

    public function do_edit_staff(Request $request, $staff_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'first_name' => 'required|regex:/^[\pL\s]+$/u|min:3|max:255',
            'last_name' => 'required|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:255',
            'contact_number' => 'required|size:10|regex:/[0-9]{10}/',
            'emergency_number' => 'size:10|regex:/[0-9]{10}/',
            'user_type_id' => 'required',
            'date_of_birth' => 'required',
            'joined_date' => 'required',
            'experience' => 'required',
            'staff_department_id' => 'required',
            'staff_type_id' => 'required',
            'photo' => 'mimes:jpeg,bmp,png',
            'emergency_number' => 'required',
            'basic_salary' => 'required',
            'total_salary' => 'required',
            'father_name' => 'required',
            'present_address' => 'required',
            'gender' => 'required',
            'marital_status' => 'required',
            'nationality' => 'required',
        ]);
        $staff = \App\Staff::find($staff_id);
        $staff->first_name = $request['first_name'];
        $staff->middle_name = $request['middle_name'];
        $staff->last_name = $request['last_name'];
        $staff->email = $request['email'];
        $staff->experience = $request['experience'];
        $staff->contact_number = $request['contact_number'];
        $staff->emergency_number = $request['emergency_number'];
        $staff->date_of_birth = $request['date_of_birth'];
        $staff->joined_date = $request['joined_date'];
        $staff->staff_type_id = $request['staff_type_id'];
        $staff->staff_department_id = $request['staff_department_id'];

        $staff->emp_designation = $request['emp_designation'];
        $staff->add_rights = $request['add_rights'];
        $staff->view_rights = $request['view_rights'];
        $staff->edit_rights = $request['edit_rights'];
        $staff->delete_rights = $request['delete_rights'];
        $staff->basic_salary = $request['basic_salary'];
        $staff->incentives = $request['incentives'];
        $staff->other_salary = $request['other_salary'];
        $staff->salary_cuttings = $request['salary_cuttings'];
        $staff->total_salary = $request['total_salary'];
        $staff->aadhaar_number = $request['aadhaar_number'];
        $staff->father_number = $request['father_number'];
        $staff->father_name = $request['father_name'];
        $staff->present_address = $request['present_address'];
        $staff->permanent_address = $request['permanent_address'];
        $staff->gender = $request['gender'];
        $staff->blood_group = $request['blood_group'];
        $staff->religion = $request['religion'];
        $staff->nationality = $request['nationality'];
        $staff->caste = $request['caste'];
        $staff->marital_status = $request['marital_status'];
        $staff->spouse_name = $request['spouse_name'];
        $staff->occupation = $request['occupation'];
        $staff->child_number = $request['child_number'];
        $staff->domicile = $request['domicile'];
        $staff->created_user_id = $created_user_id;
        $staff->academic_year_id = $academic_year_id;
        $staff->user_type_id = $request['user_type_id'];
        $old_values = \App\Staff::find($staff_id);
        if ($request->hasFile('photo')) {
            $image = $old_values->photo;
            if ($image != '') {
                $image_staff = public_path() . '/uploads/staff/' . $image;
                if (file_exists($image_staff)) {
                    unlink($image_staff);
                }
            }
            $file = Input::file('photo');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $img = $file->getClientOriginalName();
            $result = array_map('strrev', explode('.', strrev($img)));
            $name = $timestamp . '.' . $result[0];
            $file->move(public_path() . '/uploads/staff/', $name);
            $staff->photo = $name;
        }

        $data = array(
            'log_type' => 'Staff details updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['first_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $staff->update();
        return redirect('view-staff')->with(['message-success' => 'Staff ' . $request['first_name'] . ' updated successfully.']);
    }

    public function make_inactive_staff($staff_id) {
        $user = \App\Staff::where('id', $staff_id)->get();
        \App\Staff::where('id', $staff_id)->update(['status' => 0]);
        \App\User_login::where('id', $user[0]->user_login_id)->update(['status' => 0]);
        return redirect('view-staff')->with(['message-warning' => 'User ' . $user[0]->first_name . ' inactivated successfully.']);
    }

    public function make_active_staff($staff_id) {
        $user = \App\Staff::where('id', $staff_id)->get();
        \App\Staff::where('id', $staff_id)->update(['status' => 1]);
        \App\User_login::where('id', $user[0]->user_login_id)->update(['status' => 1]);
        return redirect('view-staff')->with(['message-info' => 'User ' . $user[0]->first_name . ' activated successfully.']);
    }

    public function delete_staff($staff_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $user = \App\Staff::where('id', $staff_id)->get();
        $old_values = \App\Staff::where('id', $staff_id)->get();
        if (COUNT($old_values) == 1) {
            $image = $old_values->photo;
            if ($image != '') {
                $image_user = public_path() . '/uploads/staff/' . $image;
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
        \App\Staff::where('id', $staff_id)->delete();
        \App\User_login::where('id', $user[0]->user_login_id)->delete();
        return redirect('view-staff')->with(['message-danger' => 'User ' . $user[0]->first_name . ' deleted successfully.']);
    }

    public function staff_delete_right_make_no($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['delete_rights' => 0]);
        return redirect('view-staff')->with(['message-warning' => 'Activity delete removed for staff ' . $first_name . '']);
    }

    public function staff_delete_right_make_yes($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['delete_rights' => 1]);
        return redirect('view-staff')->with(['message-info' => 'Activity delete added for staff ' . $first_name . '']);
    }

    public function staff_edit_right_make_no($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['edit_rights' => 0]);
        return redirect('view-staff')->with(['message-warning' => 'Activity edit removed for staff ' . $first_name . '']);
    }

    public function staff_edit_right_make_yes($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['edit_rights' => 1]);
        return redirect('view-staff')->with(['message-info' => 'Activity edit added for staff ' . $first_name . '']);
    }

    public function staff_view_right_make_no($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['view_rights' => 0]);
        return redirect('view-staff')->with(['message-warning' => 'Activity view removed for staff ' . $first_name . '']);
    }

    public function staff_view_right_make_yes($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['view_rights' => 1]);
        return redirect('view-staff')->with(['message-info' => 'Activity view added for staff ' . $first_name . '']);
    }

    public function staff_add_right_make_no($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['add_rights' => 0]);
        return redirect('view-staff')->with(['message-warning' => 'Activity add removed for staff ' . $first_name . '']);
    }

    public function staff_add_right_make_yes($staff_id) {
        $first_name = \App\Staff::where('id', $staff_id)->value('first_name');
        \App\Staff::where('id', $staff_id)->update(['add_rights' => 1]);
        return redirect('view-staff')->with(['message-info' => 'Activity add added for staff ' . $first_name . '']);
    }

    public function staff_summary_email(Request $request, $staff_id) {
        $print = "";
        $academic_year_id = Session::get('academic_year_id');
        $institute = \App\Institute_detail::limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->where('academic_year_id', $academic_year_id)->get();
        $staff_experiences = \App\Staff_experience::where('staff_id', $staff_id)->orderBy('created_at', 'desc')->get();
        $staff_qualifications = \App\Staff_qualification::where('staff_id', $staff_id)->get();
        $staff_documents = \App\Staff_document::where('staff_id', $staff_id)->orderBy('created_at', 'desc')->get();
        $staff_attendances = DB::select(DB::raw("SELECT staff_id,YEAR(attendance_date) as year,MONTHNAME(attendance_date) as month,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `staff_attendances` WHERE staff_id=$staff_id AND academic_year_id = $academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        $staff_salaries = \App\Staff_salary::where('staff_id', $staff_id)->where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        $staff_timetables = DB::select(DB::raw("SELECT d.day_title,su.subject_name,c.class_name,s.section_name,it.class_start,it.class_end,it.title,it.duration,cs.subject_id,cs.class_id,cs.section_id,cs.class_section_id,cs.institute_timing_id,cs.day_id,ss.staff_id FROM class_subjects cs LEFT JOIN staff_subjects ss 
ON ss.class_section_id=cs.class_section_id AND ss.subject_id=cs.subject_id 
LEFT JOIN days d ON d.id=cs.day_id LEFT JOIN institute_timings it ON it.id=cs.institute_timing_id LEFT JOIN subjects su ON su.id=ss.subject_id
LEFT JOIN classes c ON c.id=cs.class_id LEFT JOIN sections s ON s.id=cs.section_id WHERE ss.staff_id=$staff_id AND ss.academic_year_id=$academic_year_id "));
        $pdf = PDF::loadView('pdf_files.staff_summary_pdf', compact('staff_timetables', 'staff_salaries', 'staff_attendances', 'staff_documents', 'staff_qualifications', 'staff_experiences', 'print', 'staffs', 'institute'))->setPaper('a4', 'portrait');
        $url = $request->root();
        $file = public_path() . "/downloads";
        $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
        $file_name = $file . '/' . $staffs[0]->staff_unique_id . "-" . $timestamp . ".pdf";
        $pdf->save($file_name);

        // Mail::raw('bulletins.print_bulletin', function ($message) {
        $mail = Mail::send('emails.staff_summary_email', ['staffs' => $staffs, 'institute' => $institute, 'url' => $url], function($message) use ($staffs, $file_name, $institute) {
                    if (file_exists($file_name)) {
                        $message->attach($file_name);
                    }
                    $message->from($institute[0]->institution_email, $institute[0]->institution_name);
                    $message->to($staffs[0]->email, $staffs[0]->first_name)->subject($staffs[0]->staff_unique_id);
                });

        if (file_exists($file_name)) {
            unlink($file_name);
        }

        return redirect('view-staff-profile/' . $staffs[0]->id)->with(['message-success' => 'An Email has been sent to ' . $staffs[0]->first_name . ' ' . $staffs[0]->last_name . ' (' . $staffs[0]->email . ' ) ']);
    }

//     public function staff_summary_email(Request $request,$staff_id) {
//         $url = $request->root();
//        $academic_year_id = Session::get('academic_year_id');
//        $institute = \App\Institute_detail::limit(1)->get();
//        $staffs = \App\Staff::where('id', $staff_id)->where('academic_year_id', $academic_year_id)->get();
//        return view('emails/staff_summary_email',compact('institute','staffs','url'));
//     }
}
