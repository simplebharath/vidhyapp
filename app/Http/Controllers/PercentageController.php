<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Percentages;
use App\Http\Controllers\Controller;

class PercentageController extends Controller {

    public function add_percentage() {
        return view('parcentage/add_percentage');
    }

    public function do_add_percentage(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'percentage_from' => 'required|numeric|unique:percentages',
            'percentage_to' => 'required|numeric|unique:percentages',
        ]);
        $percentage = new Percentages();
        $percentage->percentage_from = $request['percentage_from'];
        $percentage->percentage_to = $request['percentage_to'];
        $percentage->created_user_id = $created_user_id;
        $percentage->academic_year_id = $academic_year_id;
        $percentage->save();
        $data = array(
            'log_type' => ' Percentage added successfully!',
            'message' => 'Added',
            'new_value' => $request['percentage_from'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-percentages')->with(['message-success' => 'Percentage ' . $request['percentage_from'] . ' added successfully.']);
    }

    public function view_percentages() {
        $percentages = Percentages::orderBy('created_at', 'desc')->get();
        return view('parcentage/view_percentage', compact('percentages'));
    }

    public function edit_percentage($percentage_id) {
        $percentages = Percentages::where('id', $percentage_id)->get();
        return view('parcentage/edit_percentage', compact('percentages'));
    }

    public function do_edit_percentage(Request $request, $percentage_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'percentage_from' => 'required|numeric|unique:percentages,percentage_from,' . Percentages::where('id', $percentage_id)->value('id'),
            'percentage_to' => 'required|numeric|unique:percentages,percentage_to,' . Percentages::where('id', $percentage_id)->value('id'),
        ]);
        $percentages = percentages::find($percentage_id);
        $percentage->percentage_from = $request['percentage_from'];
        $percentage->percentage_to = $request['percentage_to'];
        $percentages->updated_user_id = $created_user_id;
        $percentages->academic_year_id = $academic_year_id;
        $old_values = percentages::find($percentage_id);

        $data = array(
            'log_type' => 'percentage updated successfully!',
            'message' => 'Added',
            'new_value' => $request['percentage_from'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $percentages->update();
        return redirect('view-percentages')->with(['message-success' => 'percentage ' . $request['percentage_from'] . ' updated successfully.']);
    }

    public function make_inactive_percentage($percentage_id) {
        $percentage_from = Percentages::where('id', $percentage_id)->value('percentage_from');
        Percentages::where('id', $percentage_id)->update(['status' => 0]);
        return redirect('view-percentages')->with(['message-warning' => 'percentage ' . $percentage_from . ' inactivated successfully.']);
    }

    public function make_active_percentage($percentage_id) {
        $percentage_from = Percentages::where('id', $percentage_id)->value('percentage_from');
        Percentages::where('id', $percentage_id)->update(['status' => 1]);
        return redirect('view-percentages')->with(['message-info' => 'percentage ' . $percentage_from . ' activated successfully.']);
    }

    public function delete_percentage($percentage_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $percentage_from = Percentages::where('id', $percentage_id)->value('percentage_from');
        $old_values = Percentages::where('id', $percentage_id)->get();
        $data = array(
            'log_type' => 'Percentage deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Percentages::where('id', $percentage_id)->delete();
        return redirect('view-percentages')->with(['message-danger' => 'percentage ' . $percentage_from . ' deleted successfully.']);
    }

}
