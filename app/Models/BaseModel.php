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

    public function session_academic_year_id() {
        $this->academic_year_id = Session::get('academic_year_id');
        return $this->academic_year_id;
    }

    public function session_user_login_id() {
        $this->user_login_id = Session::get('user_login_id');
        return $this->user_login_id;
    }

    public function saveLogData($data) {
        DB::table('log_details')->insert($data);
        return true;
    }

    public function classScheduleTabs() {
        $this->tabs = ["class-schedule", "view-class-schedule"];
        return $this->tabs;
    }

}
