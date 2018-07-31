<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute_detail extends Model {

    protected $table = 'institute_details';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function years() {
        return $this->belongsTo('App\Academic_year','academic_year_id','id');
    }
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
     public function states() {
        return $this->belongsTo('App\State', 'state_id', 'id');
    }
     public function cities() {
        return $this->belongsTo('App\City', 'city_id', 'id');
    }
    public function fee_types() {
        return $this->belongsTo('App\Fee_type', 'fee_type_id', 'id');
    }
    public function attendance_types() {
        return $this->belongsTo('App\Attendance_type', 'attendance_type_id', 'id');
    }
   
}
