<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\User_module;
use App\User_type;
use App\Module;
use App\Http\Controllers\Controller;

class UserModulesController extends Controller {

    public function add_user_module($user_type_id) {
        $user_types = \App\User_type::where('status', 1)->where('id', $user_type_id)->get();
        $modules = DB::select(DB::raw("SELECT id,module,link,rank,image FROM modules where id NOT IN(SELECT module_id from user_modules WHERE user_type_id=$user_type_id) AND status=1"));
        return view('user_modules/add_user_module', compact('user_types', 'modules'));
    }

    public function do_add_user_module(Request $request, $user_type_id) {
        $this->validate($request, [
            'user_type_id' => 'required',
            'module_id' => 'required',
        ]);
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $modules = $request['module_id'];
        if (is_array($modules) || is_object($modules)):
            foreach ($modules as $module):
                $filesData[] = array(
                    'module_id' => $module,
                    'user_type_id' => $request['user_type_id'],
                    'created_user_id' => $created_user_id,
                    'academic_year_id' => $academic_year_id,
                );
                $modul = Module::where('id', $module)->get();
            endforeach;
            DB::table('user_modules')->insert($filesData);
        endif;

        $user_typ = User_type::where('id', $request['user_type_id'])->get();
        $data = array(
            'log_type' => ' user module added successfully!',
            'message' => 'Added',
            'new_value' => 'Modules ' . $modul . ' added to' . $user_typ,
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-user-type-modules')->with(['message-success' => 'Module(s) assigned to  user type successfully.']);
    }

    public function view_user_modules() {
        $user_modules = User_module::orderBy('created_at', 'desc')->get();
        return view('user_modules/view_user_modules', compact('user_modules'));
    }

    public function edit_user_module($user_module_id) {
        $user_modules = User_module::where('id', $user_module_id)->get();
        $user_type_id = $user_modules[0]->user_type_id;
        $user_types = \App\User_type::where('status', 1)->where('id', $user_type_id)->get();
        $modules = DB::select(DB::raw("SELECT id,module,link,rank,image FROM modules where id NOT IN(SELECT module_id from user_modules WHERE  id !=$user_module_id AND user_type_id =$user_type_id)  AND status=1"));
        return view('user_modules/edit_user_module', compact('user_types', 'modules', 'user_modules'));
    }

    public function do_edit_user_module(Request $request, $user_module_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'module_id' => 'required',
            'user_type_id' => 'required',
        ]);
        $user_modules = User_module::find($user_module_id);
        $user_modules->user_type_id = $request['user_type_id'];
        $user_modules->module_id = $request['module_id'];
        $user_modules->updated_user_id = $created_user_id;
        $user_modules->academic_year_id = $academic_year_id;
        $usermodules = User_module::where('id', $user_module_id)->get();
        $old = Module::where('id', $usermodules[0]->module_id)->value('module');
        $new = Module::where('id', $request['module_id'])->value('module');
        $usertype = User_type::where('id', $usermodules[0]->user_type_id)->value('title');
        $data = array(
            'log_type' => 'user module updated successfully!',
            'message' => 'updated',
            'new_value' => $new . $usertype,
            'old_value' => $old . $usertype,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $user_modules->update();
        return redirect('view-user-type-modules')->with(['message-success' => $usertype . '  ' . $old . ' updated as  ' . $new . ' successfully.']);
    }

    public function make_inactive_user_module($user_module_id) {
        $usermodules = User_module::where('id', $user_module_id)->get();
        $module = Module::where('id', $usermodules[0]->module_id)->value('module');
        $usertype = User_type::where('id', $usermodules[0]->user_type_id)->value('title');
        User_module::where('id', $user_module_id)->update(['status' => 0]);
        return redirect('view-user-type-modules')->with(['message-warning' => $usertype . ' module ' . $module . ' inactivated successfully']);
    }

    public function make_active_user_module($user_module_id) {
        $usermodules = User_module::where('id', $user_module_id)->get();
        $module = Module::where('id', $usermodules[0]->module_id)->value('module');
        $usertype = User_type::where('id', $usermodules[0]->user_type_id)->value('title');
        User_module::where('id', $user_module_id)->update(['status' => 1]);
        return redirect('view-user-type-modules')->with(['message-info' => $usertype . ' module ' . $module . ' activated successfully']);
    }

    public function delete_user_module($user_module_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $usermodules = User_module::where('id', $user_module_id)->get();
        $module = Module::where('id', $usermodules[0]->module_id)->value('module');
        $usertype = User_type::where('id', $usermodules[0]->user_type_id)->value('title');
        $data = array(
            'log_type' => 'class teacher deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $module . $usertype,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        User_module::where('id', $user_module_id)->delete();
        return redirect('view-user-type-modules')->with(['message-danger' => $usertype . ' module ' . $module . ' deleted successfully']);
    }

}
