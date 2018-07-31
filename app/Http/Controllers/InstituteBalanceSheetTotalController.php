<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\Http\Controllers\Controller;

class InstituteBalanceSheetTotalController extends Controller {

    public function balance_sheet_total_academic_years() {
        $academic_year_id = Session::get('academic_year_id');
        $years = \App\Academic_year::where('id', $academic_year_id)->get();
        $expenses = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE expenses.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        $payments = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id = $academic_year_id GROUP BY academic_years.id ORDER BY academic_years.id DESC"));
        return view('institute_balance_sheet_total/balance_sheet_total_academic_years', compact('years', 'payments', 'expenses'));
    }

    public function balance_sheet_total_months($academic_year_id) {
        $days = '';
        $each_day = '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id"));
        $date1 = $years[0]->from_date;
        $date2 = $years[0]->to_date;
        $output = [];
        $time = strtotime($date1);
        $last = date('m-Y', strtotime($date2));
        do {
            $month = date('m-Y', $time);
            $month_years = date('F-Y', $time);
            $months = date('F', $time);
            $yearss = date('Y', $time);
            $total = date('t', $time);
            $output[] = [
                'month' => $month,
                'days' => $total,
                'months' => $months,
                'yearsss' => $months,
                'month_years' => $month_years,
            ];
            $time = strtotime('+1 month', $time);
        } while ($month != $last);

        //print_r($output);exit;
        foreach ($output as $key => $innerArray) { {

                $monthss[] = $output[$key]['month'];
                $yearsss[] = $output[$key]['yearsss'];
                $month_yearss[] = $output[$key]['month_years'];
                $all = [
                    'as' => $monthss,
                    'bs' => $yearsss,
                    'cs' => $month_yearss,
                ];
            }
        }

        $exp = DB::select(DB::raw("SELECT   SUM(amount) as total FROM expenses LEFT JOIN academic_years ON expenses.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id"));
        $pay = DB::select(DB::raw("SELECT   SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE academic_year_id=$academic_year_id "));
        //print_r($exp[0]->total);exit;
        $payments = DB::select(DB::raw("SELECT DATE_FORMAT(payment_date,'%m-%Y') as month_year,MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC"));
        $expenses = DB::select(DB::raw("SELECT DATE_FORMAT(paid_on,'%m-%Y') as month_year,MONTHNAME(paid_on) as month,YEAR(paid_on) as year,SUM(amount) as total_amount FROM expenses WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(paid_on),MONTH(paid_on) ORDER BY paid_on DESC"));
        $total_balance = $pay[0]->total - $exp[0]->total;
        //print_r($total_balance);exit;
        return view('institute_balance_sheet_total/balance_sheet_total_months', compact('years', 'expenses', 'total_balance', 'monthss', 'output', 'months', 'payments', 'yearsss', 'month_yearss', 'days', 'each_day'));
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
        $payments = \App\Payment_record::where('fee_id', $fee_id)->where('payment_date', $date)->get();
        return view('institute_balance_sheet_payments/balance_sheet_payment_history', compact('months', 'payments', 'years', 'days', 'each_day'));
    }

}
