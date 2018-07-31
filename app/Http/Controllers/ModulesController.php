<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Module;
use App\Http\Controllers\Controller;

Class ModulesController extends Controller {

    public function add_module() {
        return view('modules/add_module');
    }

    public function do_add_module(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'module' => 'required|unique:modules',
            'link' => 'required|unique:modules',
            'rank' => 'required|unique:modules',
            'image' => 'required',
        ]);
        $modules = new Module();
        $modules->module = $request['module'];
        $modules->link = $request['link'];
        $modules->rank = $request['rank'];
        $modules->image = $request['image'];
        $modules->created_user_id = $created_user_id;
        $modules->academic_year_id = $academic_year_id;
        $modules->save();
        $data = array(
            'log_type' => ' module added successfully!',
            'message' => 'Added',
            'new_value' => $request['module'] . ' ' . $request['link'] . ' ' . $request['rank'] . ' ' . $request['image'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-modules')->with(['message-success' => 'module ' . $request['module'] . ' added successfully.']);
    }

    public function view_modules() {
        $modules = Module::orderBy('rank', 'asc')->get();
        return view('modules/view_modules', compact('modules'));
    }

    public function edit_module($module_id) {
        $modules = Module::where('id', $module_id)->get();
        return view('modules/edit_module', compact('modules'));
    }

    public function do_edit_module(Request $request, $module_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'module' => 'required|unique:modules,module,' . Module::where('id', $module_id)->value('id'),
            'link' => 'required|unique:modules,link,' . Module::where('id', $module_id)->value('id'),
            'rank' => 'required|unique:modules,rank,' . Module::where('id', $module_id)->value('id'),
            'image' => 'required',
        ]);
        $modules = Module::find($module_id);
        $modules->module = $request['module'];
        $modules->link = $request['link'];
        $modules->rank = $request['rank'];
        $modules->image = $request['image'];
        $modules->updated_user_id = $created_user_id;
        $modules->academic_year_id = $academic_year_id;
        $old_values = Module::find($module_id);

        $data = array(
            'log_type' => 'Module updated successfully!',
            'message' => 'Added',
            'new_value' => $request['module'] . ' ' . $request['link'] . ' ' . $request['rank'] . ' ' . $request['image'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $modules->update();
        return redirect('view-modules')->with(['message-success' => 'Module ' . $request['module'] . ' updated successfully.']);
    }

    public function make_inactive_module($module_id) {
        $module = Module::where('id', $module_id)->value('module');
        Module::where('id', $module_id)->update(['status' => 0]);
        return redirect('view-modules')->with(['message-warning' => 'Module ' . $module . ' inactivated successfully.']);
    }

    public function make_active_module($module_id) {
        $module = Module::where('id', $module_id)->value('module');
        Module::where('id', $module_id)->update(['status' => 1]);
        return redirect('view-modules')->with(['message-info' => 'Module ' . $module . ' activated successfully.']);
    }

    public function delete_module($module_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $module = Module::where('id', $module_id)->value('module');
        $old_values = Module::where('id', $module_id)->get();
        $data = array(
            'log_type' => 'module deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Module::where('id', $module_id)->delete();
        return redirect('view-modules')->with(['message-danger' => 'Module ' . $module . ' deleted successfully.']);
    }

}
