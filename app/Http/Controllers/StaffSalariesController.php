<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Staff_salary;
use App\Http\Controllers\Controller;

class StaffSalariesController extends Controller {

    public function add_staff_salary() {
        $staff_types = \App\Staff_type::where('status', '1')->get();
        return view('staff_salaries/add_staff_salary', compact('staff_types', 'staff'));
    }

    public function get_staff(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $staff_department_id = $request->input('staff_department_id');
        $staff_type_id = $request->input('staff_type_id');
        $staff = \App\Staff::where('staff_type_id', $staff_type_id)->where('staff_department_id', $staff_department_id)->where('academic_year_id', $academic_year_id)->get();
        return($staff);
    }

    public function get_staff_salary(Request $request) {
        $staff_id = $request->input('staff_id');
        $academic_year_id = Session::get('academic_year_id');
        $salary = \App\Staff::where('id', $staff_id)->where('academic_year_id', $academic_year_id)->get();
        return($salary);
    }

    public function get_staff_months(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $staff_id = $request->input('staff_id');
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $month_name = date('F', strtotime($current_time));
        $month_id = \App\Month::where('month', $month_name)->value('id');
        $months = DB::select(DB::raw("SELECT id,month,work_days FROM months WHERE id NOT IN(SELECT month_id FROM staff_salaries WHERE staff_id = $staff_id AND academic_year_id = $academic_year_id) AND months.id <=$month_id"));
        return($months);
    }

    public function get_staff_working_days(Request $request) {
        $staff_id = $request['staff_id'];
        $staff = \App\Staff::where('id', $staff_id)->get();
        $total_salary = $staff[0]->total_salary;

        $month_id = $request['month_id'];
        $months = \App\Month::where('id', $month_id)->get();
        $month = $months[0]->month;
        $work_days = $months[0]->work_days;
        $total_days = DB::select(DB::raw("SELECT staff_attendances.staff_id,MONTHNAME(staff_attendances.attendance_date) as month_name,count(attendance_status)as working_days,COUNT(CASE WHEN attendance_status = '1' THEN 1 END) as present FROM staff_attendances WHERE MONTHNAME(staff_attendances.attendance_date)='$month' AND staff_attendances.staff_id=$staff_id"));
        $w_days = $total_days[0]->working_days;
        $present = $total_days[0]->present;
        $absent = $w_days - $present;
        $casual_leave = \App\Institute_detail::limit(1)->value('casual_leaves');
        if ($absent > $casual_leave && $w_days > $casual_leave):
            $casual_leaves = \App\Institute_detail::limit(1)->value('casual_leaves');
        else:
            $casual_leaves = 0;
        endif;
        if ($w_days == 0 || $absent <= $casual_leave):
            $diducted_salary = 0;
        else:
            $diducted_salary = (($absent - $casual_leaves) * ($total_salary / $work_days));
        //$diducted_salary = number_format($diducted_salaries, 0);
        endif;
        $gross_salary = number_format(($total_salary - $diducted_salary), 0);

        $salar_monthly = [
            'working_days' => $w_days,
            'present' => $present,
            'total_salary' => $total_salary,
            'deducted_salary' => $diducted_salary,
            'gross_salary' => $gross_salary,
            'casual_leaves' => $casual_leave,
            'absent' => $absent,
            'salary_cut_days' => $absent - $casual_leaves
        ];
        return($salar_monthly);
    }

    public function do_add_staff_salary(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'staff_id' => 'required',
            'staff_type_id' => 'required',
            'staff_department_id' => 'required',
            'deducted_salary' => 'required',
            'gross_salary' => 'required',
            'month_id' => 'required',
        ]);

        $staff_salaries = new \App\Staff_salary();
        $staff_salaries->staff_id = $request['staff_id'];
        $staff_salaries->staff_department_id = $request['staff_department_id'];
        $staff_salaries->staff_type_id = $request['staff_type_id'];
        $staff_salaries->deducted_salary = $request['deducted_salary'];
        $staff_salaries->gross_salary = $request['gross_salary'];
        $staff_salaries->month_id = $request['month_id'];
        $staff_salaries->created_user_id = $created_user_id;
        $staff_salaries->academic_year_id = $academic_year_id;
        $staff_salaries->remark = $request['remark'];
        $staff_salaries->save();

        $staff_name = \App\Staff::where('id', $request['staff_id'])->value('first_name');
        $user_name = \App\User_login::where('id', $created_user_id)->value('user_name');
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        $salary = str_replace(',', '', $request['gross_salary']);
        $exspense = new \App\Expense();
        $exspense->expense_type_id = 1;
        $exspense->pay_to = $staff_name;
        $exspense->Amount = $salary;
        $exspense->paid_by = $user_name;
        $exspense->paid_on = $current_date;
        $exspense->description = $request['remark'];
        $exspense->created_user_id = $created_user_id;
        $exspense->academic_year_id = $academic_year_id;
        $exspense->save();
        $data = array(
            'log_type' => ' staff salary added successfully!',
            'message' => 'Added',
            'new_value' => 'Gross salary' . $request['gross_salary'] . 'deducted' . $request['deducted_salary'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-staff-salaries')->with(['message-success' => 'staff salary  added successfully.']);
    }

    public function view_staff_salary() {
        $academic_year_id = Session::get('academic_year_id');
        $staff_salaries = Staff_salary::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('staff_salaries/view_staff_salary', compact('staff_salaries'));
    }

    public function staff_salary($staff_id) {
        $academic_year_id = Session::get('academic_year_id');
        if (Session::has('staff_id')) {
            $staff_id = Session::get('staff_id');
        }
        $staffs = \App\Staff::where('id', $staff_id)->get();
        //print_r($staffs);exit;
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $classes = DB::select(DB::raw("SELECT COUNT(id) as subjects FROM staff_subjects  WHERE staff_id=$staff_id AND academic_year_id = $academic_year_id"));
        if ($classes != ''):
            $no_classes = $classes[0]->subjects;
        else:
            $no_classes = 0;
        endif;
        $staff_salaries = Staff_salary::where('staff_id', $staff_id)->where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
       // print_r($staff_salaries);exit;
        return view('staff_salaries/staff_salary', compact('staffs', 'institute_details', 'staff_salaries', 'no_classes'));
    }

    public function delete_staff_salary($staff_salary_id) {
        $academic_year_id = Session::get('academic_year_id');
        Staff_salary::where('id', $staff_salary_id)->where('academic_year_id', $academic_year_id)->delete();
        return redirect('view-staff-salaries')->with(['message-success' => 'staff salary  deleted successfully.']);
    }

}
