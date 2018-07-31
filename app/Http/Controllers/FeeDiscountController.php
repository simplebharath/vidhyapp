<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Student_type;
use App\Http\Controllers\Controller;

class FeeDiscountController extends Controller {

    public function student_fee_discount($student_id, $fee_id) {
        $institute_details = \App\Institute_detail::where('status', 1)->limit(1)->get();
        $students = \App\Student::where('id', $student_id)->get();
        $fees = \App\Fee::where('id', $fee_id)->get();
        return view('fee_discount/add_fee_discount', compact('students', 'institute_details', 'fees'));
    }

    public function get_student_total_fee(Request $request, $class_section_id) {
        $fee_id = $request->fee_id;
        if ($fee_id != 1):
            $fees = DB::select(DB::raw("SELECT fees.fee_title,fee_types.fee_name,fee_types.yearly,cf.fee_amount as fee, SUM(cf.fee_amount * fee_types.yearly) as total_amount FROM class_fees cf LEFT JOIN fees ON fees.id=cf.fee_id LEFT JOIN fee_types ON fee_types.id=cf.fee_type_id WHERE cf.fee_id=$fee_id AND cf.class_section_id=$class_section_id  "));
        else:
            $student_id = $request['student_id'];
            $stop_id = \App\Student::where('id', $student_id)->where('class_section_id', $class_section_id)->value('stop_id');
            $fees = DB::select(DB::raw("SELECT fees.fee_title,fee_types.fee_name,fee_types.yearly,tr.transport_fee as fee, SUM(tr.transport_fee * fee_types.yearly) as total_amount FROM transport_fees tr LEFT JOIN fees ON fees.id=tr.fee_id LEFT JOIN fee_types ON fee_types.id=tr.fee_type_id WHERE tr.fee_id=$fee_id AND tr.stop_id=$stop_id  "));
        endif;
        return($fees);
    }

    public function do_add_fee_discount(Request $request, $student_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $class_section_id = \App\Student::where('id', $student_id)->value('class_section_id');
        $this->validate($request, [
            'discount' => 'required',
            'fee_id' => 'required'
        ]);
        $discount = new \App\Fee_discount();
        $discount->discount = $request['discount'];
        $discount->fee_id = $request['fee_id'];
        $discount->class_section_id = $class_section_id;
        $discount->student_id = $student_id;
        $discount->created_user_id = $created_user_id;
        $discount->academic_year_id = $academic_year_id;
        $discount->save();
        $data = array(
            'log_type' => ' Discount added successfully!',
            'message' => 'Added',
            'new_value' => $request['discount'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-fee-discounts/' . $student_id)->with(['message-success' => 'Discount rupees ' . $request['discount'] . ' added successfully.']);
    }

    public function view_fee_discounts($student_id) {
        if (Session::has('student_id') || Session::has('parent_id')) {
            $student_id = Session::get('student_id');
        }
        $academic_year_id = Session::get('academic_year_id');
        $students = \App\Student::where('id', $student_id)->where('academic_year_id', $academic_year_id)->get();
        $class = $students[0]->class_section_id;
        if ($students[0]->student_type_id == 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class AND cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        endif;
        if ($students[0]->student_type_id != 2):
            $student_fees = DB::select(DB::raw("SELECT cf.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,cf.fee_amount,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM class_fees cf LEFT JOIN payment_records pr ON pr.fee_id=cf.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=cf.fee_id AND fee_discounts.student_id=$student_id  LEFT JOIN fees f ON f.id=cf.fee_id LEFT JOIN fee_types ft ON ft.id=cf.fee_type_id WHERE cf.class_section_id=$class  AND f.id !=2 AND  cf.academic_year_id = $academic_year_id GROUP BY f.id"));
        //print_r($student_fees);exit;
        endif;
        if ($students[0]->student_type_id == 1):
            $stop_id = $students[0]->stop_id;
            $transport_fees = DB::select(DB::raw("SELECT tr.fee_id,fee_discounts.id as d_id,fee_discounts.discount,ft.yearly,tr.transport_fee ,f.fee_title,f.id as fee_ids,sum(pr.paid_amount) as paid_amount,pr.student_id,ft.fee_name
FROM transport_fees tr LEFT JOIN payment_records pr ON pr.fee_id=tr.fee_id AND pr.student_id =$student_id LEFT JOIN fee_discounts ON fee_discounts.fee_id=tr.fee_id AND fee_discounts.student_id=$student_id LEFT JOIN fees f ON f.id=tr.fee_id LEFT JOIN fee_types ft ON ft.id=tr.fee_type_id  WHERE tr.stop_id=$stop_id AND tr.academic_year_id = $academic_year_id GROUP BY f.id"));

        else:
            $transport_fees = '';
        endif;
        return view('fee_discount/view_fee_discounts', compact('students', 'student_fees', 'transport_fees', 'institute_details'));
    }

    public function edit_fee_discount($discount_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $discounts = \App\Fee_discount::where('id', $discount_id)->get();
            $students = \App\Student::where('id', $discounts[0]->student_id)->get();
            return view('fee_discount/edit_fee_discount', compact('discounts', 'students'));
        } else {
            return redirect('view-fee-discounts/' . $discounts[0]->student_id);
        }
    }

    public function do_edit_fee_discount(Request $request, $d_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'discount' => 'required',
            'fee_id' => 'required',
        ]);
        $discount = \App\Fee_discount::find($d_id);
        $discount->discount = $request['discount'];
        $discount->fee_id = $request['fee_id'];

        $discount->updated_user_id = $created_user_id;
        //$discount->academic_year_id = $academic_year_id;
        $old_values = \App\Fee_discount::find($d_id);

        $data = array(
            'log_type' => 'Fee discount updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['discount'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $discount->update();
        return redirect('view-fee-discounts/' . $request['student_id'])->with(['message-success' => 'Fee discount ' . $request['discount'] . ' updated successfully.']);
    }

    public function view_all_student_fee_discounts() {
        $academic_year_id = Session::get('academic_year_id');
        $discounts = \App\Fee_discount::where('academic_year_id', $academic_year_id)->get();
        return view('fee_discount/view_all_student_discounts', compact('discounts'));
    }

}
