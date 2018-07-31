<?php

namespace App\Http\Controllers;

use \App\Student;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class InstituteBalanceSheetController extends Controller {

    public function balance_sheet_payments_academic_years() {
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id GROUP BY academic_years.id ORDER BY academic_years.id DESC") );
        return view('institute_balance_sheet/balance_sheet_payments_academic_years',compact('years'));
    }
    public function balance_sheet_payments_months($academic_year_id) {
        $days= '';
        $each_day ='';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id") );
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC") );
        return view('institute_balance_sheet/balance_sheet_payments_months',compact('months','years','days','each_day'));
    }
    public function balance_sheet_payments_day($academic_year_id,$year,$month) {
        $each_day= '';
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id") );
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  GROUP BY YEAR(payment_date),MONTH(payment_date) ORDER BY payment_date DESC") );
        $days =DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));
        return view('institute_balance_sheet/balance_sheet_payments_day',compact('months','years','days','each_day'));
    }
    public function balance_sheet_payments_day_total($academic_year_id,$year,$month,$day) {
        $years = DB::select(DB::raw("SELECT academic_years.id as ac_id,DATE_FORMAT(academic_years.from_date,' %d-%m-%Y') as start_date,DATE_FORMAT(academic_years.to_date,' %d-%m-%Y') as end_date,academic_years.id,academic_years.from_date, MONTHNAME(academic_years.from_date) as start_month,YEAR(academic_years.from_date) as start_year, MONTHNAME(academic_years.to_date) as end_month,YEAR(academic_years.to_date) as end_year,academic_years.to_date,  SUM(paid_amount) as total FROM payment_records LEFT JOIN academic_years ON payment_records.academic_year_id=academic_years.id WHERE payment_records.academic_year_id=$academic_year_id  GROUP BY academic_years.id") );
        $months = DB::select(DB::raw("SELECT MONTHNAME(payment_date) as month,YEAR(payment_date) as year,SUM(paid_amount) as total_amount FROM payment_records WHERE academic_year_id=$academic_year_id  AND YEAR(payment_date)='$year' AND MONTH(payment_date)='$month' ORDER BY payment_date DESC") );
        $days =DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND payment_records.academic_year_id =$academic_year_id  GROUP BY DAY(payment_records.payment_date) ORDER BY payment_date DESC"));
        $each_day = DB::select(DB::raw("SELECT YEAR(payment_records.payment_date) as year,MONTHNAME(payment_records.payment_date) as month_name,DAYNAME(payment_records.payment_date) as day, DATE_FORMAT(payment_records.payment_date, '%d-%m-%Y') as date,SUM(payment_records.paid_amount) as total_payments FROM payment_records  WHERE payment_records.academic_year_id =$academic_year_id AND MONTHNAME(payment_records.payment_date)='$month' AND YEAR(payment_records.payment_date)='$year' AND DATE_FORMAT(payment_records.payment_date, '%d')='$day'  GROUP BY fee_id "));
        return view('institute_balance_sheet/balance_sheet_payments_day_total',compact('months','years','days','each_day'));
    }

}
