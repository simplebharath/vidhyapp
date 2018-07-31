<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Expense_type;
use App\Http\Controllers\Controller;

class ExpenseTypesController extends Controller {

    public function add_expense_type() {
        return view('expense_types/add_expense_type');
    }

    public function do_add_expense_type(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:expense_types',
        ]);
        $expense_types = new Expense_type();
        $expense_types->title = $request['title'];
        $expense_types->created_user_id = $created_user_id;
        $expense_types->academic_year_id = $academic_year_id;
        $expense_types->save();
        $data = array(
            'log_type' => ' Expense Type added successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-expense-types')->with(['message-success' => 'Expense Type' . $request['title'] . ' added successfully.']);
    }

    public function view_expense_types() {
        $expense_types = Expense_type::orderBy('created_at', 'desc')->get();
        return view('expense_types/view_expense_types', compact('expense_types'));
    }

    public function edit_expense_type($expense_type_id) {
        $expense_types = Expense_type::where('id', $expense_type_id)->get();
        return view('expense_types/edit_expense_type', compact('expense_types'));
    }

    public function do_edit_expense_type(Request $request, $expense_type_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'title' => 'required|unique:expense_types,title,',
        ]);
        $expense_types = Expense_type::find($expense_type_id);
        $expense_types->title = $request['title'];
        $expense_types->updated_user_id = $created_user_id;
        //$expense_types->academic_year_id = $academic_year_id;
        $old_values = Expense_type::find($expense_type_id);

        $data = array(
            'log_type' => 'Expense Type updated successfully!',
            'message' => 'Added',
            'new_value' => $request['title'],
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $expense_types->update();
        return redirect('view-expense-types')->with(['message-success' => 'Expense Type ' . $request['title'] . ' updated successfully.']);
    }

    public function delete_expense_type($expense_type_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $title = Expense_type::where('id', $expense_type_id)->value('title');
        $old_values = Expense_type::where('id', $expense_type_id)->get();
        $data = array(
            'log_type' => 'Expense Type deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Expense_type::where('id', $expense_type_id)->delete();
        return redirect('view-expense-types')->with(['message-danger' => 'Expense Type ' . $title . ' deleted successfully.']);
    }

    public function make_inactive_expense_type($expense_type_id) {
        $title = Expense_type::where('id', $expense_type_id)->value('title');
        Expense_type::where('id', $expense_type_id)->update(['status' => 0]);
        return redirect('view-expense-types')->with(['message-warning' => 'Expense Type ' . $title . ' inactivated successfully.']);
    }

    public function make_active_expense_type($expense_type_id) {
        $title = Expense_type::where('id', $expense_type_id)->value('title');
        Expense_type::where('id', $expense_type_id)->update(['status' => 1]);
        return redirect('view-expense-types')->with(['message-info' => 'Expense Type ' . $title . ' activated successfully.']);
    }

}
