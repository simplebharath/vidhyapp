<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Fuel;
use App\Http\Controllers\Controller;

class FuelController extends Controller {

    public function view_fuel() {
        $academic_year_id = Session::get('academic_year_id');
        $fuels = Fuel::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('fuel/view_fuel', compact('fuels'));
    }

    public function add_fuel() {
        $academic_year_id = Session::get('academic_year_id');
        $vehicle_drivers = \App\Vehicle_driver::where('academic_year_id', $academic_year_id)->where('status', '1')->get();
        return view('fuel/add_fuel', compact('vehicle_drivers'));
    }

    public function get_driver(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $driver_id = $request['driver_id'];
        $vehicle_driver = DB::table('vehicle_drivers')->
                leftJoin('vehicles', 'vehicles.id', '=', 'vehicle_drivers.vehicle_id')
                ->leftJoin('vehicle_routes', 'vehicle_routes.id', '=', 'vehicle_drivers.route_id')
                ->leftJoin('staff', 'staff.id', '=', 'vehicle_drivers.staff_id')
                ->leftJoin('fuels', 'fuels.vehicle_driver_id', '=', 'vehicle_drivers.id')
                ->select('staff.contact_number', 'staff.middle_name', 'staff.last_name', 'staff.first_name', 'vehicle_routes.route_to', 'vehicle_routes.route_from', 'vehicle_routes.route_title')
                ->where('vehicle_drivers.id', $driver_id)
                ->where('vehicle_drivers.academic_year_id', $academic_year_id)
                ->get();
        return ($vehicle_driver);
    }

    public function do_add_fuel(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'vehicle_driver_id' => 'required',
            'rate_for_liter' => 'required',
            'kilometre' => 'required',
            'date' => 'required',
        ]);

        $fuel = new Fuel();
        $fuel->vehicle_driver_id = $request['vehicle_driver_id'];
        $fuel->rate_for_liter = $request['rate_for_liter'];
        $fuel->remarks = $request['remarks'];
        $fuel->kilometre = $request['kilometre'];
        $fuel->date = $request['date'];
        $fuel->created_user_id = $created_user_id;
        $fuel->academic_year_id = $academic_year_id;
        $fuel->save();
        $data = array(
            'log_type' => ' Fuel added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-fuel')->with(['message-success' => 'Fuel  added successfully.']);
    }

    public function edit_fuel($fuel_id) {
        $academic_year_id = Session::get('academic_year_id');
        $fuels = Fuel::where('id', $fuel_id)->get();
        $vehicle_drivers = \App\Vehicle_driver::where('status', '1')->where('academic_year_id', $academic_year_id)->get();
        return view('fuel/edit_fuel', compact('fuels', 'vehicle_drivers'));
    }

    public function do_edit_fuel(Request $request, $fuel_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'vehicle_driver_id' => 'required',
            'rate_for_liter' => 'required',
            'kilometre' => 'required',
            'date' => 'required',
        ]);
        $fuels = Fuel::find($fuel_id);
        $fuels->vehicle_driver_id = $request['vehicle_driver_id'];
        $fuels->rate_for_liter = $request['rate_for_liter'];
        $fuels->remarks = $request['remarks'];
        $fuels->kilometre = $request['kilometre'];
        $fuels->date = $request['date'];
        $fuels->created_user_id = $created_user_id;
        $fuels->academic_year_id = $academic_year_id;
        $old_values = Fuel::find($fuel_id);

        $data = array(
            'log_type' => 'Fuel updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $fuels->update();
        return redirect('view-fuel')->with(['message-success' => 'Fuel  updated successfully.']);
    }

    public function delete_fuel($fuel_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');

        $old_values = Fuel::where('id', $fuel_id)->get();
        $data = array(
            'log_type' => 'Fuel deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Fuel::where('id', $fuel_id)->delete();
        return redirect('view-fuel')->with(['message-danger' => 'Fuel deleted successfully.']);
    }

    public function make_inactive_fuel($fuel_id) {
        Fuel::where('id', $fuel_id)->update(['status' => 0]);
        return redirect('view-fuel')->with(['message-warning' => 'Fuel  inactivated successfully.']);
    }

    public function make_active_fuel($fuel_id) {
        Fuel::where('id', $fuel_id)->update(['status' => 1]);
        return redirect('view-fuel')->with(['message-info' => 'Fuel  activated successfully.']);
    }

}
