<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Http\Controllers\Controller;

class StaffAttendanceController extends Controller {

    public function add_staff_attendance() {
        $add = Session::get('add');
        if ($add == 1) {
            $staff_types = \App\Staff_type::where('status', '1')->get();
            $staffs = "";
            return view('staff_attendance/get_staff', compact('staff_types', 'staffs'));
        } else {
            return redirect('view-staff-attendance');
        }
    }

    public function get_staff_all(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $add = Session::get('add');
        if ($add == 1) {
            $staff_types = \App\Staff_type::where('status', '1')->get();
            $staff_type_id = $request['staff_type_id'];
            $staff_department_id = $request['staff_department_id'];
            if ($staff_type_id == '' && $staff_department_id == '') {
                $staffs = \App\Staff::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
                if ($staffs == '') {
                    return redirect('add-staff-attendance');
                }
            }
            if ($staff_type_id != '' && $staff_department_id == '') {
                $staffs = \App\Staff::where('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->where('status', 1)->get();
                if (COUNT($staffs) == 0) {
                    $staff_type_title = \App\Staff_type::where('id', $staff_type_id)->value('title');
                    return redirect('add-staff-attendance')->with(['message1-info' => 'There is no ' . $staff_type_title . ' staff.']);
                }
            }

            if ($staff_type_id != '' && $staff_department_id != '') {
                $staffs = \App\Staff::where('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->where('status', 1)->where('staff_department_id', $staff_department_id)->get();
                if (COUNT($staffs) == 0) {
                    $staff_type_title = \App\Staff_type::where('id', $staff_type_id)->value('title');
                    $staff_department = \App\Staff_department::where('id', $staff_department_id)->value('title');
                    return redirect('add-staff-attendance')->with(['message1-info' => 'There is no staff in ' . $staff_type_title . ' - ' . $staff_department . ' department.']);
                }
            }
            return view('staff_attendance/add_staff_attendance', compact('staffs', 'staff_types'));
        } else {
            return redirect('view-staff-attendance');
        }
    }

    public function save_staff_attendance(Request $request) {
        if ($request['attendance_status'] == ''):
            return redirect('add-staff-attendance')->with(['message1-info' => 'No staff in this department']);
        endif;
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'attendance_status' => 'required',
            'attendance_date' => 'required',
            'staff_department_id' => 'required',
            'staff_type_id' => 'required',
        ]);

        $attendance_date = $request['attendance_date'];
        $formated_date = date("Y-m-d", strtotime($request['attendance_date']));
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        if ($formated_date > $current_date):
            return redirect('add-staff-attendance')->with(['message1-success' => 'Please select date before or equal to' . $attendance_date]);
        endif;
        $day_name = date('l', strtotime($attendance_date));
        $working_day = \App\Day::where('day_title', $day_name)->value('working_day');
        if ($working_day == 0):
            return redirect('add-staff-attendance')->with(['message1-success' => ' ' . $day_name . ' is not a working day.']);
        endif;
        $holidays = \App\Institute_holiday::where('holiday_date', $attendance_date)->get();
        if (COUNT($holidays) != 0):
            return redirect('add-staff-attendance')->with(['message1-info' => 'Today is' . $holidays[0]->title . ' Holiday .']);
        endif;

        $staff_type = $request['staff_type_id'];
        $departmrent = $request['staff_department_id'];

        foreach ($staff_type as $key => $value):
            //$staff_id = $key;
            $staff_types = $value;
            $st_department_id = $departmrent[$key];
            $check = \App\Staff_attendance::where('attendance_date', $formated_date)->where('staff_type_id', $staff_types)->where('staff_department_id', $st_department_id)->get();
            if (COUNT($check) != 0):
                return redirect('add-staff-attendance')->with(['message1-info' => 'Attendance  already taken on ' . $attendance_date . ' .']);
            endif;
        endforeach;

        $reason = $request['reason'];
        $attendance_status = $request['attendance_status'];
        foreach ($attendance_status as $key => $value):
            $staff_id = $key;
            $status = $value;
            $reasons = $reason[$key];
            $staff_type_id = $staff_type[$key];
            $s_department_id = $departmrent[$key];
            $staff_attendance = new \App\Staff_attendance();
            $staff_attendance->attendance_status = $status;
            $staff_attendance->reason = $reasons;
            $staff_attendance->staff_id = $staff_id;
            $staff_attendance->staff_type_id = $staff_type_id;
            $staff_attendance->staff_department_id = $s_department_id;
            $staff_attendance->attendance_date = $formated_date;
            $staff_attendance->created_user_id = $created_user_id;
            $staff_attendance->academic_year_id = $academic_year_id;
            $staff_attendance->save();
        endforeach;
        $data = array(
            'log_type' => ' Staff attendance added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('add-staff-attendance')->with(['message-success' => 'Attendance  added successfully.']);
    }

    public function view_staff_attendance() {
        $academic_year_id = Session::get('academic_year_id');
        $staff_attendances = \App\Staff_attendance::where('academic_year_id', $academic_year_id)->orderby('attendance_date', 'asc')->get();
        return view('staff_attendance/view_staff_attendance', compact('staff_attendances'));
    }

    public function view_staff_total_attendance($staff_id) {
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
        if ($classes != ''):
            $no_classes = $classes[0]->subjects;
        else:
            $no_classes = 0;
        endif;
        $staff_attendances = DB::select(DB::raw("SELECT staff_id,YEAR(attendance_date) as year,MONTHNAME(attendance_date) as month,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM `staff_attendances` WHERE staff_id=$staff_id AND academic_year_id = $academic_year_id GROUP BY YEAR(attendance_date),MONTH(attendance_date)"));
        //print_r($staff_attendances);exit;
        return view('staff_attendance/view_staff_total_attendace', compact('staffs', 'institute_details', 'staff_attendances', 'no_classes'));
    }

    public function view_staff_monthly_attendance($month, $staff_id) {
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $staffs = \App\Staff::where('id', $staff_id)->get();
        $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id"));
        if ($classes != ''):
            $no_classes = $classes[0]->subjects;
        else:
            $no_classes = 0;
        endif;
        $staff_attendances = DB::select(DB::raw("SELECT YEAR(staff_attendances.attendance_date) as year,staff_attendances.staff_id,MONTHNAME(staff_attendances.attendance_date) as month_name,DAYNAME(staff_attendances.attendance_date) as day, DATE_FORMAT(staff_attendances.attendance_date, '%d-%m-%Y') as date,staff_attendances.attendance_status,staff_attendances.reason FROM staff_attendances WHERE MONTHNAME(staff_attendances.attendance_date)='$month' AND staff_attendances.staff_id=$staff_id AND staff_attendances.academic_year_id = $academic_year_id"));
        $year = $staff_attendances[0]->year;
        return view('staff_attendance/view_staff_monthly_attendace', compact('staffs', 'institute_details', 'staff_attendances', 'no_classes', 'month', 'year'));
    }

//    ******************************************
    public function edit_staff_attendance() {
        $edit = Session::get('edit');
        if ($edit == 1) {
            $staff_types = \App\Staff_type::where('status', '1')->get();
            $staffs = "";
            return view('staff_attendance/edit_staff_attendance_form', compact('staff_types', 'staffs'));
        } else {
            return redirect('view-staff-attendance');
        }
    }

    public function get_staff_edit_attendance(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $edit = Session::get('edit');
        if ($edit == 1) {
            $this->validate($request, [
                'attendance_date' => 'required',
            ]);

            $attendance_date = $request['attendance_date'];
            $formated_date = date("Y-m-d", strtotime($attendance_date));
            $staff_type_id = $request['staff_type_id'];
            $staff_department_id = $request['staff_department_id'];
            if ($attendance_date != '') {
                $date = \App\Staff_attendance::where('attendance_date', $formated_date)->where('academic_year_id', $academic_year_id)->get();
                if (COUNT($date) == 0) {
                    return redirect('edit-staff-attendance')->with(['message1-info' => 'Attendance on date "' . $attendance_date . '" not taken.']);
                }
            }
            if ($staff_type_id == '' && $staff_department_id == '') {
                $staffs = \App\Staff_attendance::where('attendance_date', $formated_date)->where('academic_year_id', $academic_year_id)->get();
                if (COUNT($staffs) == 0) {
                    return redirect('edit-staff-attendance')->with(['message1-info' => 'Attendance on date "' . $attendance_date . '" not taken']);
                }
            }
            if ($staff_type_id != '' && $staff_department_id == '') {
                $staffs = \App\Staff_attendance::where('attendance_date', $formated_date)->where('staff_type_id', $staff_type_id)->where('academic_year_id', $academic_year_id)->get();
                if (COUNT($staffs) == 0) {
                    $staff_type_title = \App\Staff_type::where('id', $staff_type_id)->value('title');
                    return redirect('edit-staff-attendance')->with(['message1-info' => 'Attendance for ' . $staff_type_title . ' not taken.']);
                }
            }

            if ($staff_type_id != '' && $staff_department_id != '') {
                $staffs = \App\Staff_attendance::where('attendance_date', $formated_date)->where('staff_type_id', $staff_type_id)->where('staff_department_id', $staff_department_id)->where('academic_year_id', $academic_year_id)->get();
                if (COUNT($staffs) == 0) {
                    $staff_type_title = \App\Staff_type::where('id', $staff_type_id)->value('title');
                    $staff_department = \App\Staff_department::where('id', $staff_department_id)->value('title');
                    return redirect('edit-staff-attendance')->with(['message1-info' => 'Atendance for ' . $staff_type_title . ' - ' . $staff_department . ' not taken.']);
                }
            }
            return view('staff_attendance/edit_staff_attendance', compact('staffs', 'staff_types', 'attendance_date'));
        } else {
            return redirect('view-staff-attendance');
        }
    }

    public function update_staff_attendance(Request $request) {
        //print_r($request['attendance_status']);exit;
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'attendance_status' => 'required',
            'attendance_date' => 'required',
            'staff_department_id' => 'required',
            'staff_type_id' => 'required',
        ]);

        $attendance_date = $request['attendance_date'];
        $formated_date = date("Y-m-d", strtotime($attendance_date));
        //$current_time = \Carbon\Carbon::now()->toDateTimeString();
        $staff_type = $request['staff_type_id'];
        $departmrent = $request['staff_department_id'];

        $reason = $request['reason'];
        $attendance_status = $request['attendance_status'];
        //print_r($attendance_status);
        //exit;
        foreach ($attendance_status as $key => $value):
//            print_r($value);
//            exit;
            $staff_id = $key;
            $status = $value;
            $reasons = $reason[$key];
            $staff_type_id = $staff_type[$key];
            $s_department_id = $departmrent[$key];
            $attendance_id = \App\Staff_attendance::where('attendance_date', $formated_date)->where('staff_type_id', $staff_type_id)->where('staff_department_id', $s_department_id)->where('staff_id', $staff_id)->value('id');
            //$attendance_id = $request['attendance_id'];
// print_r($attendance_id);exit;
            $staff_attendance = \App\Staff_attendance::find($attendance_id);
            $staff_attendance->attendance_status = $status;
            $staff_attendance->reason = $reasons;
            $staff_attendance->staff_id = $staff_id;
            $staff_attendance->staff_type_id = $staff_type_id;
            $staff_attendance->staff_department_id = $s_department_id;
            $staff_attendance->attendance_date = $formated_date;
            $staff_attendance->updated_user_id = $created_user_id;
            $staff_attendance->academic_year_id = $academic_year_id;
            $staff_attendance->update();
        endforeach;
        $data = array(
            'log_type' => ' Staff attendance updated successfully!',
            'message' => 'Updated',
            'new_value' => '',
            'old_value' => '',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
//print_r('$expression');exit;
        return redirect('view-staff-attendance')->with(['message-success' => 'Attendance  updated successfully.']);
    }

}
