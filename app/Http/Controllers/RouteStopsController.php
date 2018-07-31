<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Route_stop;
use App\Http\Controllers\Controller;

class RouteStopsController extends Controller {

    public function view_route_stops() {
        $route_stops = Route_stop::orderBy('created_at', 'desc')->get();
        return view('route_stops/view_route_stops', compact('route_stops'));
    }

    public function add_route_stop() {
        $vehicle_routs = \App\Vehicle_route::where('status', '1')->get();
        return view('route_stops/add_route_stop', compact('vehicle_routs'));
    }

    public function do_aadd_route_stop(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'stop_name' => 'required',
            'stop_latitude' => 'required',
            'stop_longitude' => 'required',
            'pickup_time' => 'required',
            'drop_time' => 'required|after:pickup_time',
            'route_id' => 'required',
            'stop_address' => 'required',
        ]);
        $route_stops = new Route_stop();
        $route_stops->stop_name = $request['stop_name'];
        $route_stops->stop_latitude = $request['stop_latitude'];
        $route_stops->stop_longitude = $request['stop_longitude'];
        $route_stops->stop_address = $request['stop_address'];
        $route_stops->pickup_time = $request['pickup_time'];
        $route_stops->drop_time = $request['drop_time'];
        $route_stops->route_id = $request['route_id'];
        $route_stops->created_user_id = $created_user_id;
        $route_stops->academic_year_id = $academic_year_id;
        $route_stops->save();
        $data = array(
            'log_type' => ' Route Stop added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('view-route-stops')->with(['message-success' => 'Route Stop  added successfully.']);
    }

    public function delete_route_stop($route_stop_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $route_stops = Route_stop::where('status', 1)->value('id');
        $data = array(
            'log_type' => 'route stop   details deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $route_stops,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Route_stop::where('id', $route_stop_id)->delete();
        return redirect('view-route-stops')->with(['message-danger' => 'Route Stop details deleted successfully ']);
    }

    public function make_inactive_route_stop($route_stop_id) {
        $stop_name = Route_stop::where('id', $route_stop_id)->value('stop_name');
        Route_stop::where('id', $route_stop_id)->update(['status' => 0]);
        return redirect('view-route-stops')->with(['message-warning' => 'Route Stop Inactivated successfully.']);
    }

    public function make_active_route_stop($route_stop_id) {
        $stop_name = Route_stop::where('id', $route_stop_id)->value('stop_name');
        Route_stop::where('id', $route_stop_id)->update(['status' => 1]);
        return redirect('view-route-stops')->with(['message-info' => 'Route Stop  activated successfully.']);
    }

    public function edit_route_stop($route_stop_id) {
        $route_stops = Route_stop::where('id', $route_stop_id)->get();
        $vehicle_routs = \App\Vehicle_route::where('status', '1')->get();
        return view('route_stops/edit_route_stop', compact('route_stops', 'vehicle_routs'));
    }

    public function do_edit_route_stop(Request $request, $route_stop_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'stop_name' => 'required',
            'stop_latitude' => 'required',
            'stop_longitude' => 'required',
            'route_id' => 'required',
            'stop_address' => 'required',
        ]);
        $route_stops = Route_stop::find($route_stop_id);
        $route_stops->stop_name = $request['stop_name'];
        $route_stops->route_id = $request['route_id'];
        $route_stops->stop_latitude = $request['stop_latitude'];
        $route_stops->stop_address = $request['stop_address'];
        $route_stops->stop_longitude = $request['stop_longitude'];
        $route_stops->pickup_time = $request['pickup_time'];
        $route_stops->drop_time = $request['drop_time'];
        $route_stops->updated_user_id = $created_user_id;
        $route_stops->academic_year_id = $academic_year_id;
        $old_values = Route_stop::find($route_stop_id);

        $data = array(
            'log_type' => 'Route Stop updated successfully!',
            'message' => 'Updated',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $route_stops->update();
        return redirect('view-route-stops')->with(['message-success' => 'Route Stop updated successfully.']);
    }

}
