<?php

namespace App\Http\Controllers;

use Session;
use DB;
use App\Http\Controllers\Controller;

class InstituteBalanceSheetExpensesController extends Controller {

    public function balance_sheet_expenses_academic_years() {
        $academic_year_id = Session::get('academic_year_id');
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        return view('institute_balance_sheet_expenses/balance_sheet_expenses_academic_years', compact('years'));
    }

    public function balance_sheet_expenses_months($academic_year_id) {
        $days = '';
        $each_day = '';
        $expenses = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        return view('institute_balance_sheet_expenses/balance_sheet_expenses_months', compact('months', 'expenses', 'years', 'days', 'each_day'));
    }

    public function balance_sheet_expenses_day($academic_year_id, $year, $month) {
        $each_day = '';
        $expenses = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $days = DB::select(DB::raw("SELECT YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses  WHERE MONTHNAME(expenses.paid_on)='$month' AND YEAR(expenses.paid_on)='$year' AND expenses.academic_year_id =$academic_year_id  GROUP BY DAY(expenses.paid_on) ORDER BY paid_on DESC"));
        return view('institute_balance_sheet_expenses/balance_sheet_expenses_day', compact('months', 'years', 'expenses', 'days', 'each_day'));
    }

    public function balance_sheet_expenses_day_fees($academic_year_id, $year, $month, $day) {
        $expenses = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  AND YEAR(paid_on)='$year' AND MONTHNAME(paid_on)='$month' ORDER BY paid_on DESC"));
        $days = DB::select(DB::raw("SELECT YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,SUM(expenses.amount) as total_expenses,DATE_FORMAT(expenses.paid_on, '%d') as today FROM expenses  WHERE MONTHNAME(expenses.paid_on)='$month' AND YEAR(expenses.paid_on)='$year' AND expenses.academic_year_id =$academic_year_id  GROUP BY DAY(expenses.paid_on) ORDER BY paid_on DESC"));
        $each_day = DB::select(DB::raw("SELECT expenses.id,expenses.expense_type_id,expense_types.id, expense_types.title,YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses LEFT JOIN expense_types ON expense_types.id =expenses.expense_type_id WHERE expenses.academic_year_id =$academic_year_id AND MONTHNAME(expenses.paid_on)='$month' AND YEAR(expenses.paid_on)='$year' AND DATE_FORMAT(expenses.paid_on, '%d')='$day'  GROUP BY expense_type_id "));
        return view('institute_balance_sheet_expenses/balance_sheet_expenses_day_fees', compact('months', 'expenses', 'years', 'days', 'each_day'));
    }

    public function balance_sheet_expense_history($academic_year_id, $year, $month, $day, $expense_type_id) {
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  AND YEAR(paid_on)='$year' AND MONTHNAME(paid_on)='$month' ORDER BY paid_on DESC"));
        $days = DB::select(DB::raw("SELECT YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day,DATE_FORMAT(expenses.paid_on, '%d') as today, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,SUM(expenses.amount) as total_expenses FROM expenses  WHERE MONTHNAME(expenses.paid_on)='$month' AND YEAR(expenses.paid_on)='$year' AND expenses.academic_year_id =$academic_year_id AND DATE_FORMAT(expenses.paid_on, '%d')=$day  GROUP BY DAY(expenses.paid_on) ORDER BY paid_on DESC"));
        $each_day = DB::select(DB::raw("SELECT expenses.id,expenses.expense_type_id,expense_types.id, expense_types.title,YEAR(expenses.paid_on) as year,MONTHNAME(expenses.paid_on) as month_name,DAYNAME(expenses.paid_on) as day, DATE_FORMAT(expenses.paid_on, '%d-%m-%Y') as date,DATE_FORMAT(expenses.paid_on, '%d') as today,SUM(expenses.amount) as total_expenses FROM expenses LEFT JOIN expense_types ON expense_types.id =expenses.expense_type_id WHERE expenses.academic_year_id =$academic_year_id AND MONTHNAME(expenses.paid_on)='$month' AND YEAR(expenses.paid_on)='$year' AND DATE_FORMAT(expenses.paid_on, '%d')='$day'  GROUP BY expense_type_id "));
        $month_number = date('m', strtotime($month));
        $join = [$year, $month_number, $day];
        $date = implode("-", $join);
        $expenses = \App\Expense::where('expense_type_id', $expense_type_id)->where('paid_on', $date)->where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();
        return view('institute_balance_sheet_expenses/balance_sheet_expenses_history', compact('months', 'expenses', 'years', 'days', 'each_day'));
    }

    public function balance_sheet_expenses_chart() {
        $academic_year_id = Session::get('academic_year_id');
        $total = DB::select(DB::raw("SELECT SUM(amount) as total FROM expenses WHERE academic_year_id=$academic_year_id "));
        $sum = $total[0]->total;
        $months = DB::select(DB::raw("SELECT MONTHNAME(paid_on) as month,YEAR(paid_on) as year,ROUND(((SUM(amount)/$sum)*100),1) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id GROUP BY MONTH(paid_on),YEAR(paid_on)"));
        foreach ($months as $m) {
            $month_name[] = $m->month;
            $b = number_format($m->total_amount, 1);
            $a[] = (int) $b;
        }
        $v['labels'] = $month_name;
        $v['expenses'] = $a;
        return Response()->json($v);
    }

}
