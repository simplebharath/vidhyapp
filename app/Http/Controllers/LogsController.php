<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;

Class LogsController extends Controller {

    public function log_history() {
        $academic_year_id = Session::get('academic_year_id');
        $logs = \App\Log::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('logs/log_history', compact('logs'));
    }

    public function log_details() {
        $academic_year_id = Session::get('academic_year_id');
        $logs = \App\Log_detail::where('academic_year_id', $academic_year_id)->orderBy('created_at', 'desc')->get();
        return view('logs/log_details', compact('logs'));
    }

    public function log_details_search(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $query = $request->input('search');
        $logs['logs'] = \App\Log_detail::
                where('log_details.id', 'LIKE', '%' . $query . '%')
                ->orWhere('log_details.created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('log_details.log_type', 'LIKE', '%' . $query . '%')
                ->orWhere('log_details.message', 'LIKE', '%' . $query . '%')
                ->orWhere('log_details.old_value', 'LIKE', '%' . $query . '%')
                ->orWhere('log_details.new_value', 'LIKE', '%' . $query . '%')
                ->where('academic_year_id', $academic_year_id)
                ->get();

        return view('logs/log_details', $logs, ['value' => $query]);
    }

    public function log_history_search(Request $request) {
        $academic_year_id = Session::get('academic_year_id');
        $query = $request->input('search');
        $logs['logs'] = \App\Log::where('id', 'LIKE', '%' . $query . '%')
                ->orWhere('log_type', 'LIKE', '%' . $query . '%')
                ->orWhere('created_at', 'LIKE', '%' . $query . '%')
                ->orWhere('user_login_id', 'LIKE', '%' . $query . '%')
                ->orWhere('ip_address', 'LIKE', '%' . $query . '%')
                ->orWhere('log_in', 'LIKE', '%' . $query . '%')
                ->orWhere('log_out', 'LIKE', '%' . $query . '%')
                ->orWhere('user_browser', 'LIKE', '%' . $query . '%')
                ->orderBy('created_at', 'DESC')
                ->where('academic_year_id', $academic_year_id)
                ->get();

        return view('logs/log_history', $logs, ['value' => $query]);
    }

}
