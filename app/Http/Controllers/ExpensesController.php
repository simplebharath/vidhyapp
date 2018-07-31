<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Expense;
use App\Http\Controllers\Controller;

class ExpensesController extends Controller {

    public function add_expense() {
        $exspense = \App\Expense_type::where('status', '1')->where('id', '!=', 1)->get();
        return view('expenses/add_expense', compact('exspense'));
    }

    public function do_add_expense(Request $request) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'expense_type_id' => 'required',
            'pay_to' => 'required',
            'amount' => 'required',
        ]);
        $user_name = \App\User_login::where('id', $created_user_id)->value('user_name');
        $current_time = \Carbon\Carbon::now()->toDateTimeString();
        $current_date = date("Y-m-d", strtotime($current_time));
        $exspense = new Expense();
        $exspense->expense_type_id = $request['expense_type_id'];
        $exspense->pay_to = $request['pay_to'];
        $exspense->amount = $request['amount'];
        $exspense->paid_by = $user_name;
        $exspense->paid_on = $current_date;
        $exspense->description = $request['description'];
        $exspense->created_user_id = $created_user_id;
        $exspense->academic_year_id = $academic_year_id;
        $exspense->save();
        $data = array(
            'log_type' => ' Expenses added successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => 'No old values',
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        return redirect('view-expenses')->with(['message-success' => 'Expenses  added successfully.']);
    }

    public function view_expenses() {
        $academic_year_id = Session::get('academic_year_id');
        $expenses = Expense::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('expenses/view_expenses', compact('expenses'));
    }

    public function edit_expense($expense_id) {
        $expenses = Expense::where('id', $expense_id)->get();
        return view('expenses/edit_expense', compact('expenses'));
    }

    public function do_edit_expense(Request $request, $expense_id) {
        $created_user_id = Session::get('user_login_id');
        $academic_year_id = Session::get('academic_year_id');
        $this->validate($request, [
            'pay_to' => 'required',
            'amount' => 'required',
            'paid_by' => 'required',
            'paid_on' => 'required',
        ]);

        $expenses = Expense::find($expense_id);
        $expenses->expense_type_id = $request['expense_type_id'];
        $expenses->pay_to = $request['pay_to'];
        $expenses->amount = $request['amount'];
        $expenses->paid_by = $request['paid_by'];
        $expenses->paid_on = $request['paid_on'];
        $expenses->description = $request['description'];
        $expenses->created_user_id = $created_user_id;
        //$expenses->academic_year_id = $academic_year_id;
        $old_values = Expense::find($expense_id);
        $data = array(
            'log_type' => 'Expense updated successfully!',
            'message' => 'Added',
            'new_value' => '',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        $expenses->update();
        return redirect('view-expenses')->with(['message-success' => 'Expense  updated successfully.']);
    }

    public function delete_expense($expense_id) {
        $academic_year_id = Session::get('academic_year_id');
        $created_user_id = Session::get('user_login_id');
        $old_values = Expense::where('id', $expense_id)->get();
        $data = array(
            'log_type' => 'Expense deleted successfully!',
            'message' => 'Deleted',
            'new_value' => 'No new values',
            'old_value' => $old_values,
            'academic_year_id' => $academic_year_id,
            'user_login_id' => $created_user_id);
        DB::table('log_details')->insert($data);
        Expense::where('id', $expense_id)->delete();
        return redirect('view-expenses')->with(['message-danger' => 'Expense deleted successfully.']);
    }

    public function make_inactive_expense($expense_id) {
        $expenses = Expense::where('id', $expense_id)->get();
        Expense::where('id', $expense_id)->update(['status' => 0]);
        return redirect('view-expenses')->with(['message-warning' => 'Expense  inactivated successfully.']);
    }

    public function make_active_expense($expense_id) {
        $expenses = Expense::where('id', $expense_id)->get();
        Expense::where('id', $expense_id)->update(['status' => 1]);
        return redirect('view-expenses')->with(['message-info' => 'Expense  activated successfully.']);
    }

}
