<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Fee_type;
use App\Fee;
use App\Http\Controllers\Controller;

class AssignFeetypesController extends Controller {

    public function add_fee_feetype() {
        $add = Session::get('add');
        if ($add == 1) {
            $fee_types = Fee_type::where('status', 1)->get();
            $fees = DB::select(DB::raw("SELECT id,fee_title FROM `fees`where id NOT IN(SELECT fee_id from assign_feetypes) AND status=1"));
            return view('assign_fee_types/add_fee_feetype', compact('fees', 'fee_types'));
        } else {
            return redirect('view-fee-feetypes');
        }
    }

//    public function get_fees(Request $request) {
//        $fee_type_id = $request->input('fee_type_id');
//        $fees = DB::select(DB::raw("SELECT id,fee_title FROM `fees`where id NOT IN(SELECT fee_id from assign_feetypes) AND status=1"));
//        return ($fees);
//    }

    public function do_add_fee_feetype(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_type_id' => 'required',
            'fee_id' => 'required',
        ]);
        $fees = Fee::where('id', $request['fee_id'])->value('non_editable');
        $fee_feetypes = new \App\Assign_feetype();
        if ($fees == 1):
            $fee_feetypes->non_editable = 1;
        endif;
        $fee_feetypes->fee_type_id = $request['fee_type_id'];
        $fee_feetypes->fee_id = $request['fee_id'];
        $fee_feetypes->created_user_id = $created_user_id;
        $fee_feetypes->academic_year_id = $academic_year_id;
        $data = array(
            'log_type' => ' Fe fee-type added successfully',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $fee_feetypes->save();
        return redirect('view-fee-feetypes')->with(['message-success' => 'Fee feetype added successfully.']);
    }

    public function view_fee_feetype() {
        $fee_feetypes = \App\Assign_feetype::orderby('created_at', 'desc')->get();
        return view('assign_fee_types/view_fee_feetypes', compact('fee_feetypes'));
    }

    public function edit_fee_feetype($fee_feetype_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');

        if (($edit == 1) && ($view == 1)) {
            $fee_feetypes = \App\Assign_feetype::where('id', $fee_feetype_id)->get();
            $fee_types = Fee_type::where('status', 1)->get();
            return view('assign_fee_types/edit_fee_feetype', compact('fee_feetypes', 'fee_types'));
        } else {
            return redirect('view-fee-feetypes');
        }
    }

    public function do_edit_fee_feetype(Request $request, $fee_feetype_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_type_id' => 'required',
            'fee_id' => 'required',
        ]);
        $fees = Fee::where('id', $request['fee_id'])->value('non_editable');
        $fee_feetypes = \App\Assign_feetype::find($fee_feetype_id);
        if ($fees == 1):
            $fee_feetypes->non_editable = 1;
        endif;
        $fee_feetypes->fee_type_id = $request['fee_type_id'];
        $fee_feetypes->fee_id = $request['fee_id'];
        $fee_feetypes->created_user_id = $created_user_id;
        //$fee_feetypes->academic_year_id = $academic_year_id;
        $data = array(
            'log_type' => 'Class-section updated successfully!',
            'message' => 'updated',
            'new_value' => '',
            'old_value' => '',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $fee_feetypes->update();
        return redirect('view-fee-feetypes')->with(['message-success' => 'Fee fee-type updated successfully.']);
    }

    public function make_inactive_fee_feetype($fee_feetype_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            \App\Assign_feetype::where('id', $fee_feetype_id)->update(['status' => 0]);
            return redirect('view-fee-feetypes')->with(['message-warning' => 'Fee fee-type inactivated successfully.']);
        } else {
            return redirect('view-fee-feetypes');
        }
    }

    public function make_active_fee_feetype($fee_feetype_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            \App\Assign_feetype::where('id', $fee_feetype_id)->update(['status' => 1]);
            return redirect('view-fee-feetypes')->with(['message-info' => 'Fee fee-type activated successfully.']);
        } else {
            return redirect('view-fee-feetypes');
        }
    }

    public function delete_fee_feetype($fee_feetype_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            \App\Assign_feetype::where('id', $fee_feetype_id)->delete();
            return redirect('view-fee-feetypes')->with(['message-danger' => 'Fee fee-type deleted successfully.']);
        } else {
            return redirect('view-fee-feetypes');
        }
    }

}
