<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff_subject extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function classes() {
        return $this->belongsTo('App\Classes','class_id','id');
    }
     public function sections() {
        return $this->belongsTo('App\Section','section_id','id');
    }
    public function subjects() {
        return $this->belongsTo('App\Subject','subject_id','id');
    }
    public function days() {
        return $this->belongsTo('App\Day','day_id','id');
    }
     public function timings() {
        return $this->belongsTo('App\Institute_timing','institute_timing_id','id');
    }
    
public function staff() {
        return $this->belongsTo('App\Staff','staff_id','id');
    }
    public function staff_types() {
        return $this->belongsTo('App\Staff_type', 'staff_type_id', 'id');
    }
    public function staff_department() {
        return $this->belongsTo('App\Staff_department','staff_department_id','id');
    } 
}
