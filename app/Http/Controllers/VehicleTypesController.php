<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Vehicle_type;
use App\Http\Controllers\Controller;

class VehicleTypesController extends Controller {

    public function view_vehicle_types() {
        $vehicle_types = Vehicle_type::orderBy('created_at', 'desc')->get();
        return view('vehicle_types/view_vehicle_types', compact('vehicle_types'));
    }

    public function add_vehicle_type() {
        return view('vehicle_types/add_vehicle_type');
    }

    public function do_add_vehicle_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:vehicle_types',
        ]);
        $vehicle_types = new Vehicle_type();
        $vehicle_types->title = $request['title'];
        $vehicle_types->created_user_id = $created_user_id;
        $vehicle_types->academic_year_id = $academic_year_id;
        $vehicle_types->save();
        $data = array(
            'log_type' => ' Vehicle types added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-vehicle-types')->with(['message-success' => 'Vehicle type' . $request['title'] . ' added successfully.']);
    }

    public function edit_vehicle_type($vehicle_type_id) {
        $vehicle_types = Vehicle_type::where('id', $vehicle_type_id)->get();
        return view('vehicle_types/edit_vehicle_type', compact('vehicle_types'));
    }

    public function do_edit_vehicle_type(Request $request, $vehicle_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:vehicle_types,title,' . vehicle_type::where('id', $vehicle_type_id)->value('id'),
        ]);
        $vehicle_types = Vehicle_type::find($vehicle_type_id);
        $vehicle_types->title = $request['title'];
        $vehicle_types->updated_user_id = $created_user_id;
        $vehicle_types->academic_year_id = $academic_year_id;
        $old_values = Vehicle_type::find($vehicle_type_id);

        $data = array(
            'log_type' => 'Vehicle types updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $vehicle_types->update();
        return redirect('view-vehicle-types')->with(['message-success' => 'Attendance type ' . $request['title'] . ' updated successfully.']);
    }

    public function delete_vehicle_type($vehicle_type_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = Vehicle_type::where('id', $vehicle_type_id)->value('title');
        $old_values = Vehicle_type::where('id', $vehicle_type_id)->get();
        $data = array(
            'log_type' => 'vehicle Type deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Vehicle_type::where('id', $vehicle_type_id)->delete();
        return redirect('view-vehicle-types')->with(['message-danger' => 'vehicle type ' . $title . ' deleted successfully.']);
    }

    public function make_inactive_vehicle_type($vehicle_type_id) {
        $title = Vehicle_type::where('id', $vehicle_type_id)->value('title');
        Vehicle_type::where('id', $vehicle_type_id)->update(['status' => 0]);
        return redirect('view-vehicle-types')->with(['message-warning' => 'vehicle type ' . $title . ' inactivated successfully.']);
    }

    public function make_active_vehicle_type($vehicle_type_id) {
        $title = Vehicle_type::where('id', $vehicle_type_id)->value('title');
        Vehicle_type::where('id', $vehicle_type_id)->update(['status' => 1]);
        return redirect('view-vehicle-types')->with(['message-info' => 'vehicle type ' . $title . ' activated successfully.']);
    }

}
