<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Controllers\Controller;

class StudentFeePaymentsController extends Controller {

    public function students_fee_payments() {
        $academic_year_id = Session::get('academic_year_id');
        $classes = \App\Class_section::where('academic_year_id', $academic_year_id)->where('status', 1)->get();
        return view('student_fee_payments/students_fee_payments', compact('classes'));
    }

    public function get_class_students(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request['class_section_id'];
        $students = \App\Student::where('status', 1)->where('academic_year_id', $academic_year_id)->where('class_section_id', $class_section_id)->get();
        return($students);
    }

    public function view_students_list(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = $request['class_section_id'];
        $student_id = $request['student_id'];
        $student_name = $request['student_name'];
        if ($student_name != ''):
            $students = \App\Student::where('status', 1)
                    ->where('first_name', 'LIKE', '%' . $student_name . '%')
                    ->orWhere('roll_number', 'LIKE', '%' . $student_name . '%')
                    ->orWhere('unique_id', 'LIKE', '%' . $student_name . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $student_name . '%')
                    ->orWhere('middle_name', 'LIKE', '%' . $student_name . '%')
                    ->where('academic_year_id', $academic_year_id)
                    ->get();
        endif;
        if ($class_section_id != '' && $student_id != ''):
            return redirect('view-student-fee/' . $student_id);
        endif;
        if ($class_section_id != '' && $student_id == ''):
            $students = \App\Student::where('status', 1)->where('academic_year_id', $academic_year_id)->where('class_section_id', $class_section_id)->get();
        endif;
        if ($class_section_id == '' && $student_id == '' && $student_name == ''):
            $students = \App\Student::where('status', 1)->where('academic_year_id', $academic_year_id)->get();
        endif;
        if ($class_section_id == '' && $student_id != ''):
            return redirect('view-student-fee/' . $student_id);
        endif;
        return view('student_fee_payments/view_students_list', compact('students'));
    }

    public function view_students_by_id($s_id) {
        $academic_year_id = Session::get('academic_year_id');
        $c_s_id = \App\Student::where('id', $s_id)->where('academic_year_id', $academic_year_id)->value('class_section_id');
        $students = \App\Student::where('status', 1)->where('academic_year_id', $academic_year_id)->where('class_section_id', $c_s_id)->get();
        return view('student_fee_payments/view_students_list', compact('students'));
    }

    public function view_student_fee($student_id) {
//        $academic_year = \App\Institute_detail::where('status', 1)->limit(1)->value('academic_year_id');
//        $academic_years = \App\Academic_year::where('id', $academic_year)->get();
//        $year1 = date('Y', strtotime($academic_years[0]->from_date));
//        $year2 = date('Y', strtotime($academic_years[0]->to_date));
//        $month1 = date('m', strtotime($academic_years[0]->from_date));
//        $month2 = date('m', strtotime($academic_years[0]->to_date));
//        $diff = (($year2 - $year1) * 12) + ($month2 - $month1);
        // $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $academic_year_id = Session::get('academic_year_id');
        $student = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $class = $student[0]->class_section_id;
        if ($student[0]->student_type_id == 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class AND cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        endif;
        if ($student[0]->student_type_id != 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id  LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class  AND f.id !=2 AND  cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        endif;
        if ($student[0]->student_type_id == 1):
            $stop_id = $student[0]->stop_id;
            $transport_fees = DB::select(DB::raw("SELECT tr.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,tr.transport_fee ,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM transport_fees tr LEFT JOIN payment_records pr ON pr.fee_id=tr.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=tr.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=tr.fee_id LEFT JOIN fee_types ft ON ft.id=tr.fee_type_id  WHERE tr.stop_id=$stop_id AND tr.academic_year_id = $academic_year_id GROUP BY f.id"));

        else:
            $transport_fees = '';
        endif;
        $payments = \App\Payment_record::where('student_id', $student_id)->where('academic_year_id', $academic_year_id)->orderby('created_at', 'desc')->get();
        return view('student_fee_payments/view_student_fees', compact('student_fees', 'institute_details', 'student', 'transport_fees', 'payments'));
    }

    public function pay_student_fee(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $student_id = $request['student_id'];
        $fee_id = $request['fee_id'];
        $student = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $class = $student[0]->class_section_id;
        if ($fee_id != 1) {
            $student_fees = DB::select(DB::raw("SELECT fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class AND f.id=$fee_id AND cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        }
        if ($fee_id == 1) {
            $stop_id = $student[0]->stop_id;
            $student_fees = DB::select(DB::raw("SELECT fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,tr.transport_fee as fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM transport_fees tr LEFT JOIN payment_records pr ON pr.fee_id=tr.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=tr.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=tr.fee_id LEFT JOIN fee_types ft ON ft.id=tr.fee_type_id  WHERE tr.stop_id=$stop_id AND f.id=$fee_id AND tr.academic_year_id = $academic_year_id GROUP BY f.id"));
        }
        return($student_fees);
    }

    public function do_pay_fee_now(Request $request, $student_id) {
        $created_user_id = Session::get('user_login_id');
        $institute = \App\Institute_detail::where('status', '1')->get();
        $academic_year_id = Session::get('academic_year_id');
        $institute_code = $institute[0]->institution_code;

        if ($request['paid_by'] == '' && $request['amount'] == ''):
            return redirect('view-student-fee/' . $student_id)->with(['message1-warning' => 'Payment Unsuccessfull,Please enter amount to pay and payer name.']);
        endif;
        if ($request['amount'] == ''):
            return redirect('view-student-fee/' . $student_id)->with(['message1-warning' => 'Payment Unsuccessfull,Please enter amount to pay.']);
        endif;
        if ($request['paid_by'] == ''):
            return redirect('view-student-fee/' . $student_id)->with(['message1-warning' => 'Payment Unsuccessfull,Please enter name of the payer.']);
        endif;
        $due = $request['due_amount'];
        $pay = $request['amount'];
        if ($pay > $due):
            return redirect('view-student-fee/' . $student_id)->with(['message1-warning' => 'Payment Unsuccessfull,' . $request['amount'] . $request['due_amount'] . 'We will not take,more than the due amount.']);
        endif;
        $receipt_number = DB::select(DB::raw("SELECT max(id) as receipt_no FROM payment_records"));
        if ($receipt_number != ''):
            $receipt = $receipt_number[0]->receipt_no;
        else:
            $receipt = 0;
        endif;
        $new_num = $receipt + 1;
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        $date = explode("-", $current_date);
        $number = $date[0] . $date[1] . $date[2];
        $r = $new_num . ' ' . $number;
        $join = [$institute_code, 'P', $r];
        $unique_receipt = implode("-", $join);
        $payment_records = new \App\Payment_record();
        $payment_records->paid_amount = $request['amount'];
        $payment_records->paid_by = $request['paid_by'];
        $payment_records->fee_id = $request['fee_id'];
        $payment_records->payment_mode = $request['payment_mode'];
        $payment_records->payment_details = $request['payment_details'];
        $payment_records->student_id = $student_id;
        $payment_records->class_section_id = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->value('class_section_id');
        $payment_records->receipt_number = $unique_receipt;
        $payment_records->payment_date = $current_date;
        $payment_records->created_user_id = $created_user_id;
        $payment_records->academic_year_id = $academic_year_id;
        $payment_records->save();
        $data = array(
            'log_type' => 'Fee payment successfully completed!',
            'message' => 'Added',
            'new_value' => $request['amount'] . '-' . $request['paid_by'],
            'old_value' => 'No old values',
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-student-fee/' . $student_id)->with(['message-success' => 'Fee amount ' . $request['amount'] . ' ' . 'paid successfully by ' . $request['paid_by']]);
    }

    public function payment_history_institute() {
        $academic_year_id = Session::get('academic_year_id');
        $payments = \App\Payment_record::where('academic_year_id', $academic_year_id)->orderby('created_at', 'asc')->get();
        return view('student_fee_payments/payment_history_institute', compact('payments'));
    }

}
