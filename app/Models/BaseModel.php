<?php

namespace App\Models;

use Session;
use DB;
use App\Classes;
use App\Section;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model {

    public function __construct() {
        
    }

    public static function session_academic_year_id() {
        return Session::get('academic_year_id');
    }

    public static function session_user_login_id() {
        return Session::get('user_login_id');
    }

    public static function saveLogData($data) {
        DB::table('log_details')->insert($data);
        return true;
    }
    
}
