<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Fee;
use App\Http\Controllers\Controller;

class FeeController extends Controller {

    public function add_fee() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-fees');
        } else {
            return view('fees/add_fee');
        }
    }

    public function do_add_fee(Request $request) {
        $user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_title' => 'required|unique:fees',
        ]);
        $fees = new Fee();
        $fees->fee_title = $request['fee_title'];
        $fees->created_user_id = $user_id;
        $fees->academic_year_id = $academic_year_id;
        $data = array(
            'log_type' => 'fee added successfully!',
            'message' => 'Added',
            'new_value' => $request['fee_title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $user_id);
        DB::table('log_details')->insert($data);
        $fees->save();
        return redirect('view-fees')->with(['message-success' => 'fees ' . $request['fee_title'] . ' added successfully.']);
    }

    public function view_fee() {
        $fees = Fee:: orderBy('created_at', 'desc')->get();
        return view('fees/view_fees', compact('fees'));
    }

    public function edit_fee($fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $fees = Fee::where('id', $fee_id)->get();
            return view('fees/edit_fee', compact('fees'));
        } else {
            return redirect('view-fees');
        }
    }

    public function do_edit_fee(Request $request, $fee_id) {
        $user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_title' => 'required|unique:fees,fee_title,' . Fee::where('id', $fee_id)->value('id'),
        ]);
        $fees = Fee::find($fee_id);
        $fees->fee_title = $request['fee_title'];
        //$fees->academic_year_id = $academic_year_id;
        $fees->updated_user_id = $user_id;
        $fees->update();
        $old_values = Fee::where('id', $fee_id)->get();
        $data = array(
            'log_type' => 'fee updated successfully!',
            'message' => 'Added',
            'new_value' => $request['fee_title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $user_id);
        DB::table('log_details')->insert($data);

        return redirect('view-fees')->with(['message-success' => 'fee ' . $request['fee_title'] . ' updated successfully.']);
    }

    public function make_inactive_fee($fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $fee_title = Fee::where('id', $fee_id)->value('fee_title');
            Fee::where('id', $fee_id)->update(['status' => 0]);
            return redirect('view-fees')->with(['message-warning' => 'Fee ' . $fee_title . ' inactivated successfully.']);
        } else {
            return redirect('view-fees');
        }
    }

    public function make_active_fee($fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $fee_title = Fee::where('id', $fee_id)->value('fee_title');
            Fee::where('id', $fee_id)->update(['status' => 1]);
            return redirect('view-fees')->with(['message-info' => 'Fee ' . $fee_title . ' activated successfully.']);
        } else {
            return redirect('view-fees');
        }
    }

    public function delete_fee($fee_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($delete == 1) && ($view == 1)) {
            $fee_title = Fee::where('id', $fee_id)->value('fee_title');
            $old_values = Fee::where('id', $fee_id)->get();
            $user_id = Session::get('user_login_id');
            $academic_year_id = Session::get('academic_year_id');
            $data = array(
                'log_type' => 'Fee deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $user_id);
            DB::table('log_details')->insert($data);
            Fee::where('id', $fee_id)->delete();
            return redirect('view-fees')->with(['message-danger' => 'Fee ' . $fee_title . ' deleted successfully.']);
        } else {
            return redirect('view-fees');
        }
    }

}
