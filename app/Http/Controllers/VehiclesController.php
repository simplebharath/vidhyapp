<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Vehicle;
use App\Http\Controllers\Controller;
use \Input as Input;
use Carbon\Carbon;

class VehiclesController extends Controller {

    public function add_vehicle() {
        $vehicle_types = \App\Vehicle_type::where('status', '1')->get();
        return view('vehicles/add_vehicle', compact('vehicle_types'));
    }

    public function do_add_vehicle(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'vehicle_number' => 'required',
            'owner_name' => 'required',
            'owner_number' => 'required',
            'owner_image' => 'mimes:jpeg,bmp,png',
            'vehicle_image' => 'mimes:jpeg,bmp,png',
        ]);
        $vehicles = new Vehicle();
        $vehicles->vehicle_number = $request['vehicle_number'];
        $vehicles->description = $request['description'];
        $vehicles->engine_number = $request['engine_number'];
        $vehicles->owner_name = $request['owner_name'];
        $vehicles->owner_number = $request['owner_number'];
        $vehicles->owner_email = $request['owner_email'];
        $vehicles->created_user_id = $created_user_id;
        $vehicles->academic_year_id = $academic_year_id;
        $vehicles->vehicle_type_id = $request['vehicle_type_id'];
        if ($request->hasFile('owner_image')) {
            $file = Input::file('owner_image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/transport/owner_image/', $name);
            $vehicles->owner_image = $name;
        }
        if ($request->hasFile('vehicle_image')) {
            $file = Input::file('vehicle_image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/transport/vehicle_image/', $name);
            $vehicles->vehicle_image = $name;
        }
        $vehicles->save();
        $data = array(
            'log_type' => ' Vehicle added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);

        return redirect('view-vehicles')->with(['message-success' => 'vehicle  added successfully.']);
    }

    public function view_vehicle() {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->get();
        return view('vehicles/view_vehicles', compact('vehicles'));
    }

    public function delete_vehicle($vehicle_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $vehicles = Vehicle::where('status', 1)->get();
        if ($vehicles[0]->vehicle_image != '') {
            $image_staff = public_path() . '/uploads/transport/vehicle_image/' . $vehicles[0]->vehicle_image;
            if (file_exists($image_staff)) {
                unlink($image_staff);
            }
        }
        if ($vehicles[0]->owner_image != '') {
            $image_staff = public_path() . '/uploads/transport/owner_image/' . $vehicles[0]->owner_image;
            if (file_exists($image_staff)) {
                unlink($image_staff);
            }
        }
        $data = array(
            'log_type' => 'Vehicle   details deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $vehicles,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Vehicle::where('id', $vehicle_id)->delete();
        return redirect('view-vehicles')->with(['message-danger' => 'Vehicle details deleted successfully ']);
    }

    public function make_inactive_vehicle($vehicle_id) {

        Vehicle::where('id', $vehicle_id)->update(['status' => 0]);
        return redirect('view-vehicles')->with(['message-warning' => 'vehicle inactivated successfully.']);
    }

    public function make_active_vehicle($vehicle_id) {

        Vehicle::where('id', $vehicle_id)->update(['status' => 1]);
        return redirect('view-vehicles')->with(['message-info' => 'vehicle activated successfully.']);
    }

    public function edit_vehicle($vehicle_id) {
        $vehicles = Vehicle::where('id', $vehicle_id)->get();
        $vehicle_types = \App\Vehicle_type::where('status', '1')->get();
        return view('vehicles/edit_vehicle', compact('vehicles', 'vehicle_types'));
    }

    public function do_edit_vehicle(Request $request, $vehicle_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'vehicle_number' => 'required',
            'owner_name' => 'required',
            'owner_number' => 'required',
        ]);
        $vehicles = Vehicle::find($vehicle_id);
        $vehicles->vehicle_number = $request['vehicle_number'];
        $vehicles->engine_number = $request['engine_number'];
        $vehicles->owner_name = $request['owner_name'];
        $vehicles->owner_number = $request['owner_number'];
        $vehicles->description = $request['description'];
        $vehicles->updated_user_id = $created_user_id;
        $vehicles->academic_year_id = $academic_year_id;
        $old_values = Vehicle::find($vehicle_id);
        if ($request->hasFile('vehicle_image')) {
            $image = $old_values->vehicle_image;
            if ($image != '') {
                $image_staff = public_path() . '/uploads/transport/vehicle_image/' . $image;
                if (file_exists($image_staff)) {
                    unlink($image_staff);
                }
            }
            $file = Input::file('vehicle_image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/transport/vehicle_image/', $name);
            $vehicles->vehicle_image = $name;
        }
        if ($request->hasFile('owner_image')) {
            $image = $old_values->owner_image;
            if ($image != '') {
                $image_staff = public_path() . '/uploads/transport/owner_image/' . $image;
                if (file_exists($image_staff)) {
                    unlink($image_staff);
                }
            }
            $file = Input::file('owner_image');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/uploads/transport/owner_image/', $name);
            $vehicles->owner_image = $name;
        }
        $data = array(
            'log_type' => 'Vehicle updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $vehicles->update();
        return redirect('view-vehicles')->with(['message-success' => 'vehicle  updated successfully.']);
    }

}
