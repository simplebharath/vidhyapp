<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Meter_reading;
use App\Http\Controllers\Controller;

class MeterReadingController extends Controller {

    public function view_meter_reading() {
        $academic_year_id = Session::get('academic_year_id');
        $meter_readings = Meter_reading::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('meter_readings/view_meter_reading', compact('meter_readings'));
    }

    public function add_meter_reading() {
        $academic_year_id = Session::get('academic_year_id');
        $vehicle_drivers = \App\Vehicle_driver::where('academic_year_id', $academic_year_id)->where('status', '1')->get();
        return view('meter_readings/add_meter_reading', compact('vehicle_drivers'));
    }

    public function do_add_meter_reading(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'reading' => 'required',
            'date' => 'required',
        ]);
        $meter_readings = new Meter_reading();
        $meter_readings->reading = $request['reading'];
        $meter_readings->date = $request['date'];
        $meter_readings->remarks = $request['remarks'];
        $meter_readings->vehicle_driver_id = $request['vehicle_driver_id'];
        $meter_readings->created_user_id = $created_user_id;
        $meter_readings->academic_year_id = $academic_year_id;
        $meter_readings->save();
        $data = array(
            'log_type' => ' Meter Reading added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-meter-reading')->with(['message-success' => 'meter Reading  added successfully.']);
    }

    public function edit_meter_reading($meter_reading_id) {
        $academic_year_id = Session::get('academic_year_id');
        $meter_readings = Meter_reading::where('id', $meter_reading_id)->get();
        $vehicle_drivers = \App\Vehicle_driver::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
        return view('meter_readings/edit_meter_reading', compact('meter_readings', 'vehicle_drivers'));
    }

    public function do_edit_meter_reading(Request $request, $meter_reading_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $this->validate($request, [
            'reading' => 'required',
            'date' => 'required',
        ]);
        $meter_readings = Meter_reading::find($meter_reading_id);
        $meter_readings->reading = $request['reading'];
        $meter_readings->date = $request['date'];
        $meter_readings->remarks = $request['remarks'];
        $meter_readings->vehicle_driver_id = $request['vehicle_driver_id'];
        $meter_readings->created_user_id = $created_user_id;
        //$meter_readings->academic_year_id = $academic_year_id;
        $old_values = Meter_reading::find($meter_reading_id);

        $data = array(
            'log_type' => 'Meter Reading updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $meter_readings->update();
        return redirect('view-meter-reading')->with(['message-success' => 'Meter Reading  updated successfully.']);
    }

    public function delete_meter_reading($meter_reading_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Meter_reading::where('id', $meter_reading_id)->get();
        $data = array(
            'log_type' => 'Meter Reading deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Meter_reading::where('id', $meter_reading_id)->delete();
        return redirect('view-meter-reading')->with(['message-danger' => 'Meter Reading deleted successfully.']);
    }

    public function make_inactive_meter_reading($meter_reading_id) {
        Meter_reading::where('id', $meter_reading_id)->update(['status' => 0]);
        return redirect('view-meter-reading')->with(['message-warning' => 'Meter Reading  inactivated successfully.']);
    }

    public function make_active_meter_reading($meter_reading_id) {
        Meter_reading::where('id', $meter_reading_id)->update(['status' => 1]);
        return redirect('view-meter-reading')->with(['message-info' => 'Meter Reading  activated successfully.']);
    }

}
