<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Vehicle_driver;
use App\Http\Controllers\Controller;

class VehicleDriversController extends Controller {

    public function view_vehicle_drivers() {
        $academic_year_id = Session::get('academic_year_id');
        $vehicle_drivers = Vehicle_driver::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('vehicle_drivers/view_vehicle_drivers', compact('vehicle_drivers'));
    }

    public function add_vehicle_driver() {
        $academic_year_id = Session::get('academic_year_id');
        $staff = DB::select(DB::raw("SELECT id,first_name,last_name,middle_name,staff_unique_id FROM `staff`where id NOT IN(SELECT staff_id from vehicle_drivers WHERE academic_year_id = $academic_year_id) AND academic_year_id = $academic_year_id AND user_type_id=6 AND status=1"));
        $user_types = \App\User_type::where('id', '6')->get();
        $vehicle_types = \App\Vehicle_type::where('status', '1')->get();
        $routes = DB::select(DB::raw("SELECT id,route_from,route_to,route_title FROM `vehicle_routes`where id NOT IN(SELECT route_id from vehicle_drivers WHERE academic_year_id = $academic_year_id)  AND status=1"));
        return view('vehicle_drivers/add_vehicle_driver', compact('user_types', 'vehicle_types', 'vehicles', 'routes', 'staff'));
    }

    public function get_vehicles(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $vehicle_type = $request['vehicle_type_id'];
        $vehicles = DB::select(DB::raw("SELECT vehicles.id,owner_name,vehicle_number FROM `vehicles` LEFT JOIN vehicle_types ON vehicle_types.id=vehicles.vehicle_type_id where vehicles.id NOT IN(SELECT vehicle_id from vehicle_drivers WHERE academic_year_id = $academic_year_id )AND vehicle_type_id=$vehicle_type  AND vehicles.status=1"));
        return($vehicles);
    }

    public function do_add_vehicle_driver(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'user_type_id' => 'required',
            'staff_id' => 'required',
            'vehicle_type_id' => 'required',
            'vehicle_id' => 'required',
            'route_id' => 'required',
        ]);
        $vehicle_drivers = new Vehicle_driver();
        $vehicle_drivers->user_type_id = $request['user_type_id'];
        $vehicle_drivers->staff_id = $request['staff_id'];
        $vehicle_drivers->vehicle_type_id = $request['vehicle_type_id'];
        $vehicle_drivers->vehicle_id = $request['vehicle_id'];
        $vehicle_drivers->route_id = $request['route_id'];
        $vehicle_drivers->created_user_id = $created_user_id;
        $vehicle_drivers->academic_year_id = $academic_year_id;
        $vehicle_drivers->save();
        $data = array(
            'log_type' => ' Vehicle driver added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('view-vehicle-drivers')->with(['message-success' => 'vehicle Driver added successfully.']);
    }

    public function edit_vehicle_driver($vehicle_driver_id) {
        $academic_year_id = Session::get('academic_year_id');
        $vehicle_drivers = Vehicle_driver::where('id', $vehicle_driver_id)->where('academic_year_id', $academic_year_id)->get();
        $user_types = \App\User_type::where('id', '6')->get();
        $staff_id = $vehicle_drivers[0]->staff_id;
        $vehicle_type = $vehicle_drivers[0]->vehicle_type_id;
        $vehicle_id = $vehicle_drivers[0]->vehicle_id;
        $route_id = $vehicle_drivers[0]->route_id;
        $staff = DB::select(DB::raw("SELECT id,first_name,last_name,middle_name,staff_unique_id FROM `staff`where id NOT IN(SELECT staff_id from vehicle_drivers WHERE staff_id !=$staff_id AND academic_year_id = $academic_year_id) AND user_type_id=6 AND status=1 AND academic_year_id = $academic_year_id"));
        $vehicles = DB::select(DB::raw("SELECT vehicles.id,owner_name,vehicle_number FROM `vehicles` LEFT JOIN vehicle_types ON vehicle_types.id=vehicles.vehicle_type_id where vehicles.id NOT IN(SELECT vehicle_id from vehicle_drivers WHERE vehicle_id!=$vehicle_id AND academic_year_id = $academic_year_id)AND vehicle_type_id=$vehicle_type  AND vehicles.status=1"));
        $routes = DB::select(DB::raw("SELECT id,route_from,route_to,route_title FROM `vehicle_routes`where id NOT IN(SELECT route_id from vehicle_drivers WHERE route_id !=$route_id AND academic_year_id = $academic_year_id)  AND status=1"));
        return view('vehicle_drivers/edit_vehicle_driver', compact('vehicles', 'user_types', 'routes', 'staff', 'vehicle_drivers'));
    }

    public function do_edit_vehicle_driver(Request $request, $vehicle_driver_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [

            'user_type_id' => 'required',
            'staff_id' => 'required',
            'vehicle_type_id' => 'required',
            'vehicle_id' => 'required',
            'route_id' => 'required',
        ]);
        $vehicle_drivers = Vehicle_driver::find($vehicle_driver_id);
        $vehicle_drivers->user_type_id = $request['user_type_id'];
        $vehicle_drivers->staff_id = $request['staff_id'];
        $vehicle_drivers->vehicle_type_id = $request['vehicle_type_id'];
        $vehicle_drivers->vehicle_id = $request['vehicle_id'];
        $vehicle_drivers->route_id = $request['route_id'];
        $vehicle_drivers->updated_user_id = $created_user_id;
        //$vehicle_drivers->academic_year_id = $academic_year_id;
        $old_values = Vehicle_driver::find($vehicle_driver_id);

        $data = array(
            'log_type' => 'Vehicle Driver updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $vehicle_drivers->update();
        return redirect('view-vehicle-drivers')->with(['message-success' => 'vehicle Driver updated successfully.']);
    }

    public function delete_vehicle_driver($vehicle_driver_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Vehicle_driver::where('id', $vehicle_driver_id)->get();
        $data = array(
            'log_type' => 'vehicle driver deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Vehicle_driver::where('id', $vehicle_driver_id)->delete();
        return redirect('view-vehicle-drivers')->with(['message-danger' => 'vehicle driver  deleted successfully.']);
    }

    public function make_inactive_vehicle_driver($vehicle_driver_id) {
        Vehicle_driver::where('id', $vehicle_driver_id)->update(['status' => 0]);
        return redirect('view-vehicle-drivers')->with(['message-warning' => 'vehicle Driver  inactivated successfully.']);
    }

    public function make_active_vehicle_driver($vehicle_driver_id) {
        Vehicle_driver::where('id', $vehicle_driver_id)->update(['status' => 1]);
        return redirect('view-vehicle-drivers')->with(['message-info' => 'vehicle Driver  activated successfully.']);
    }

}
