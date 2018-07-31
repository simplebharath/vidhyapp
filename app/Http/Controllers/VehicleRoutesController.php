<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Vehicle_route;
use App\Http\Controllers\Controller;

class VehicleRoutesController extends Controller {

    public function view_vehicle_routes() {
        $vehicle_routs = Vehicle_route::orderBy('created_at', 'desc')->get();
        return view('vehicle_routes/view_vehicle_routes', compact('vehicle_routs'));
    }

    public function add_vehicle_route() {
        return view('vehicle_routes/add_vehicle_route');
    }

    public function do_add_vehicle_route(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'route_title' => 'required',
            'route_from' => 'required',
            'route_from_start_time' => 'required',
            'route_from_end_time' => 'required|after:route_from_start_time',
            'route_to' => 'required',
            'route_to_start_time' => 'required',
            'route_to_end_time' => 'required|after:route_to_start_time',
        ]);
        $vehicle_routs = new Vehicle_route();
        $vehicle_routs->route_title = $request['route_title'];
        $vehicle_routs->route_from = $request['route_from'];
        $vehicle_routs->route_from_start_time = $request['route_from_start_time'];
        $vehicle_routs->route_from_end_time = $request['route_from_end_time'];
        $vehicle_routs->route_from_latitude = $request['route_from_latitude'];
        $vehicle_routs->route_from_longitude = $request['route_from_longitude'];
        $vehicle_routs->route_to = $request['route_to'];
        $vehicle_routs->route_to_start_time = $request['route_to_start_time'];
        $vehicle_routs->route_to_end_time = $request['route_to_end_time'];
        $vehicle_routs->route_to_latitude = $request['route_to_latitude'];
        $vehicle_routs->route_to_longitude = $request['route_to_longitude'];
        $vehicle_routs->created_user_id = $created_user_id;
        $vehicle_routs->academic_year_id = $academic_year_id;
        $vehicle_routs->save();
        $data = array(
            'log_type' => ' Vehicle routes added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-vehicles-routes')->with(['message-success' => 'Vehicle route added successfully.']);
    }

    public function delete_vehicle_route($vehicle_route_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $route_title = Vehicle_route::where('id', $vehicle_route_id)->value('route_title');
        $old_values = Vehicle_route::where('id', $vehicle_route_id)->get();
        $data = array(
            'log_type' => 'vehicle Route deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Vehicle_route::where('id', $vehicle_route_id)->delete();
        return redirect('view-vehicles-routes')->with(['message-danger' => 'vehicle Route  deleted successfully.']);
    }

    public function make_inactive_vehicle_route($vehicle_route_id) {
        $route_title = Vehicle_route::where('id', $vehicle_route_id)->value('route_title');
        Vehicle_route::where('id', $vehicle_route_id)->update(['status' => 0]);
        return redirect('view-vehicles-routes')->with(['message-warning' => 'vehicle Route  inactivated successfully.']);
    }

    public function make_active_vehicle_route($vehicle_route_id) {
        $route_title = Vehicle_route::where('id', $vehicle_route_id)->value('route_title');
        Vehicle_route::where('id', $vehicle_route_id)->update(['status' => 1]);
        return redirect('view-vehicles-routes')->with(['message-info' => 'vehicle Route  activated successfully.']);
    }

    public function edit_vehicle_route($vehicle_route_id) {
        $vehicle_routes = Vehicle_route::where('id', $vehicle_route_id)->get();
        return view('vehicle_routes/edit_vehicle_route', compact('vehicle_routes'));
    }

    public function do_edit_vehicle_route(Request $request, $vehicle_route_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'route_title' => 'required',
            'route_from' => 'required',
            'route_from_start_time' => 'required',
            'route_to' => 'required',
            'route_to_start_time' => 'required',
            'route_from_end_time' => 'required',
            'route_to_end_time' => 'required',
        ]);
        $vehicle_routes = Vehicle_route::find($vehicle_route_id);
        $vehicle_routes->route_title = $request['route_title'];
        $vehicle_routes->route_from = $request['route_from'];
        $vehicle_routes->route_from_start_time = $request['route_from_start_time'];
        $vehicle_routes->route_from_end_time = $request['route_from_end_time'];
        $vehicle_routes->route_from_latitude = $request['route_from_latitude'];
        $vehicle_routes->route_from_longitude = $request['route_from_longitude'];
        $vehicle_routes->route_to = $request['route_to'];
        $vehicle_routes->route_to_start_time = $request['route_to_start_time'];
        $vehicle_routes->route_to_end_time = $request['route_to_end_time'];
        $vehicle_routes->route_to_latitude = $request['route_to_latitude'];
        $vehicle_routes->route_to_longitude = $request['route_to_longitude'];
        $vehicle_routes->updated_user_id = $created_user_id;
        $vehicle_routes->academic_year_id = $academic_year_id;
        $old_values = Vehicle_route::find($vehicle_route_id);

        $data = array(
            'log_type' => 'Vehicle Route updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $vehicle_routes->update();
        return redirect('view-vehicles-routes')->with(['message-success' => 'Vehicle Route  updated successfully.']);
    }

}
