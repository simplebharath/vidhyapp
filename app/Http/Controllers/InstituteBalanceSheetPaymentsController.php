<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Controllers\Controller;

class InstituteBalanceSheetPaymentsController extends Controller {

    public function balance_sheet_payments_academic_years() {
        $academic_year_id = Session::get('academic_year_id');
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        return view('institute_balance_sheet_payments/balance_sheet_payments_academic_years', compact('years'));
    }

    public function balance_sheet_payments_months($academic_year_id) {
        $days = '';
        $each_day = '';
        $payments = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        return view('institute_balance_sheet_payments/balance_sheet_payments_months', compact('months', 'payments', 'years', 'days', 'each_day'));
    }

    public function balance_sheet_payments_day($academic_year_id, $year, $month) {
        $each_day = '';
        $payments = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        $days = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));
        return view('institute_balance_sheet_payments/balance_sheet_payments_day', compact('months', 'years', 'payments', 'days', 'each_day'));
    }

    public function balance_sheet_payments_day_fees($academic_year_id, $year, $month, $day) {
        $payments = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  AND YEAR(payment_date)='$year' AND MONTHNAME(payment_date)='$month' ORDER BY payment_date DESC"));
        $days = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,SUM(payment_records.paid_amount) as total_payments,DATE_FORMAT(payment_records.payment_date, '%d') as today FROM payment_records  WHERE MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));
        $each_day = DB::select(DB::raw("SELECT fees.fee_title,fees.id as feeid,YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records LEFT JOIN fees ON fees.id =payment_records.fee_id WHERE payment_records.academic_year_id =$academic_year_id AND MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND DATE_FORMAT(payment_records.payment_date, '%d')='$day'  GROUP BY fee_id "));
        return view('institute_balance_sheet_payments/balance_sheet_payments_day_fees', compact('months', 'payments', 'years', 'days', 'each_day'));
    }

    public function balance_sheet_payment_history($academic_year_id, $year, $month, $day, $fee_id) {
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  AND YEAR(payment_date)='$year' AND MONTHNAME(payment_date)='$month' ORDER BY payment_date DESC"));
        $days = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day,DATE_FORMAT(payment_records.payment_date, '%d') as today, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND payment_records.academic_year_id =$academic_year_id AND DATE_FORMAT(payment_records.payment_date, '%d')=$day  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));
        $each_day = DB::select(DB::raw("SELECT fees.fee_title,fees.id as feeid,YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,DATE_FORMAT(payment_records.payment_date, '%d') as today,SUM(payment_records.paid_amount) as total_payments FROM payment_records LEFT JOIN fees ON fees.id =payment_records.fee_id WHERE payment_records.academic_year_id =$academic_year_id AND MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND DATE_FORMAT(payment_records.payment_date, '%d')='$day'  GROUP BY fee_id "));
        $month_number = date('m', strtotime($month));
        $join = [$year, $month_number, $day];
        $date = implode("-", $join);
        $payments = \App\Payment_record::where('fee_id', $fee_id)->where('payment_date', $date)->where('academic_year_id', $academic_year_id)->orderBy('created_at', 'DESC')->get();
        return view('institute_balance_sheet_payments/balance_sheet_payment_history', compact('months', 'payments', 'years', 'days', 'each_day'));
    }

    public function balance_sheet_payments_chart() {
        $academic_year_id = Session::get('academic_year_id');
        $total = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total FROM payment_records WHERE academic_year_id=$academic_year_id "));
        $sum = $total[0]->total;
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,ROUND(((SUM(paid_amount)/$sum)*100),1) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date)"));
        foreach ($months as $m) {
            $month_name[] = $m->month;
            $b = number_format($m->total_amount,1);
            $a[] =(int)$b;
        }
        $v['labels'] = $month_name;
        $v['p_data'] = $a;
        return Response()->json($v);
    }

}
