<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Transport_fee;
use App\Http\Controllers\Controller;

class TransportFeesController extends Controller {

    public function add_transport_fee() {
        $add = Session::get('add');
        if ($add != 1) {
            return redirect('view-transport-fees');
        }
        $fee_types = \App\Fee_type::where('status', 1)->get();
        $fees = \App\Fee::where('status', 1)->where('non_editable', 1)->get();
        $vehicle_routes = \App\Vehicle_route::where('status', 1)->get();
        return view('transport_fees/add_transport_fee', compact('fee_types', 'fees', 'vehicle_routes'));
    }

    public function get_route_stops(Request $request) {
        $route_id = $request['vehicle_route_id'];
        $stops = DB::select(DB::raw("SELECT id,stop_name,pickup_time,drop_time,route_id FROM `route_stops`  WHERE id NOT IN(SELECT stop_id FROM transport_fees WHERE route_id=$route_id) AND status=1 AND route_id=$route_id"));
        return($stops);
    }

    public function do_add_transport_fee(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'fee_id' => 'required',
            'fee_type_id' => 'required',
            'route_id' => 'required',
            'stop_id' => 'required',
            'transport_fee' => 'required',
        ]);
        $transport_ids = DB::select(DB::raw("SELECT max(id) as transport_fee_id FROM transport_fees"));
        if ($transport_ids != ''):
            $t_f_id = $transport_ids[0]->transport_fee_id;
        else:
            $t_f_id = 0;
        endif;
        $t = $t_f_id + 1;
        $stops = $request['stop_id'];
        if (!empty($stops)):
            foreach ($stops as $stop):
                $transport_fees = new Transport_fee();
                $transport_fees->stop_id = $stop;
                $transport_fees->transport_f_id = $t;
                $transport_fees->route_id = $request['route_id'];
                $transport_fees->fee_id = $request['fee_id'];
                $transport_fees->fee_type_id = $request['fee_type_id'];
                $transport_fees->transport_fee = $request['transport_fee'];
                $transport_fees->created_user_id = $created_user_id;
                $transport_fees->academic_year_id = $academic_year_id;
                $transport_fees->save();
            endforeach;
        endif;
        $data = array(
            'log_type' => ' Transport Fee  added successfully!',
            'message' => 'Added',
            'new_value' => $request['transport_fee'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-transport-fees')->with(['message-success' => 'Transport Fee amount ' . $request['transport_fee'] . ' added successfully.']);
    }

    public function view_transport_fee() {
        $academic_year_id = Session::get('academic_year_id');
        $transport_fees = Transport_fee::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('transport_fees/view_transport_fees', compact('transport_fees'));
    }

    public function edit_transport_fee($transport_fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            $transport_fees = Transport_fee::where('id', $transport_fee_id)->get();
            return view('transport_fees/edit_transport_fee', compact('transport_fees'));
        } else {
            return redirect('view-transport-fees');
        }
    }

    public function do_edit_transport_fee(Request $request, $transport_fee_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'transport_fee' => 'required'
        ]);
        $transport_fees = Transport_fee::find($transport_fee_id);
        $transport_fees->transport_fee = $request['transport_fee'];
        $transport_fees->updated_user_id = $created_user_id;
        //$transport_fees->academic_year_id = $academic_year_id;
        $old_values = Transport_fee::find($transport_fee_id);

        $data = array(
            'log_type' => 'Transport Fee  updated successfully!',
            'message' => 'Updated',
            'new_value' => $request['transport_fee'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $transport_fees->update();
        return redirect('view-transport-fees')->with(['message-success' => 'Fee amount ' . $request['transport_fee'] . ' updated successfully.']);
    }

    public function make_inactive_transport_fee($transport_fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            Transport_fee::where('id', $transport_fee_id)->update(['status' => 0]);
            return redirect('view-transport-fees')->with(['message-warning' => 'Transport fee inactivated successfully.']);
        } else {
            return redirect('view-transport-fees');
        }
    }

    public function make_active_transport_fee($transport_fee_id) {
        $edit = Session::get('edit');
        $view = Session::get('view');
        if (($edit == 1) && ($view == 1)) {
            Transport_fee::where('id', $transport_fee_id)->update(['status' => 1]);
            return redirect('view-transport-fees')->with(['message-info' => 'Transport fee activated successfully.']);
        } else {
            return redirect('view-transport-fees');
        }
    }

    public function delete_transport_fee($transport_fee_id) {
        $delete = Session::get('delete');
        $view = Session::get('view');
        if (($view == 1) && ($delete == 1)) {
            $academic_year_id = Session::get('academic_year_id');
            $created_user_id = Session::get('user_login_id');
            $old_values = Transport_fee::where('id', $transport_fee_id)->get();
            $data = array(
                'log_type' => 'Transport fee deleted successfully!',
                'message' => 'Deleted',
                'new_value' => 'No new values',
                'old_value' => $old_values,
                'academic_year_id' => $academic_year_id,
                'user_login_id' => $created_user_id);
            DB::table('log_details')->insert($data);
            Transport_fee::where('id', $transport_fee_id)->delete();
            return redirect('view-transport-fees')->with(['message-danger' => 'Transport fee deleted successfully.']);
        } else {
            return redirect('view-transport-fees');
        }
    }

}
