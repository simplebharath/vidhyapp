<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Fee_type;
use App\Http\Controllers\Controller;

class FeeTypeController extends Controller {

    public function add_fee_type() {
        return view('fee_types/add_fee_type');
    }

    public function do_fee_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_name' => 'required|unique:fee_types',
        ]);
        $fees = new Fee_type();
        $fees->fee_name = $request['fee_name'];
        $fees->created_user_id = $created_user_id;
        $fees->academic_year_id = $academic_year_id;
        $fees->save();
        $data = array(
            'log_type' => ' Fee added successfully!',
            'message' => 'Added',
            'new_value' => $request['fee_name'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-fee-types')->with(['message-success' => 'Fee Type ' . $request['fee_name'] . ' added successfully.']);
    }

    public function view_fee_types() {
        $fees = Fee_type::orderBy('created_at', 'desc')->get();
        return view('fee_types/view_fees_type', compact('fees'));
    }

    public function edit_fee_type($fee_type_id) {
        $fees = Fee_type::where('id', $fee_type_id)->get();
        return view('fee_types/edit_fee_type', compact('fees'));
    }

    public function do_edit_fee_type(Request $request, $fee_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_name' => 'required|unique:fee_types,fee_name,' . Fee_type::where('id', $fee_type_id)->value('id'),
        ]);
        $fees = Fee_type::find($fee_type_id);
        $fees->fee_name = $request['fee_name'];
        $fees->updated_user_id = $created_user_id;
        //$fees->academic_year_id = $academic_year_id;
        $old_values = Fee_type::find($fee_type_id);

        $data = array(
            'log_type' => 'Fee Type updated successfully!',
            'message' => 'Added',
            'new_value' => $request['fee_name'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $fees->update();
        return redirect('view-fee-types')->with(['message-success' => 'Fee Type ' . $request['fee_name'] . ' updated successfully.']);
    }

    public function make_inactive_fee_type($fee_type_id) {
        $fee_name = fee_type::where('id', $fee_type_id)->value('fee_name');
        fee_type::where('id', $fee_type_id)->update(['status' => 0]);
        return redirect('view-fee-types')->with(['message-warning' => 'Fee type ' . $fee_name . ' inactivated successfully.']);
    }

    public function make_active_fee_type($fee_type_id) {
        $fee_name = fee_type::where('id', $fee_type_id)->value('fee_name');
        fee_type::where('id', $fee_type_id)->update(['status' => 1]);
        return redirect('view-fee-types')->with(['message-info' => 'Fee type ' . $fee_name . ' activated successfully.']);
    }

    public function delete_fee_type($fee_type_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $fee_name = fee_type::where('id', $fee_type_id)->value('fee_name');
        $old_values = fee_type::where('id', $fee_type_id)->get();
        $data = array(
            'log_type' => 'Fee Type deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        fee_type::where('id', $fee_type_id)->delete();
        return redirect('view-fee-types')->with(['message-danger' => 'Fee Type ' . $fee_name . ' deleted successfully.']);
    }

}
