<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'user_login_id', 'id');
    }
    public function user_types() {
        return $this->belongsTo('App\User_type', 'user_type_id', 'id');
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
    public function class_sections() {
        return $this->belongsTo('App\Class_section','class_section_id','id');
    }
     public function class_teachers() {
        return $this->belongsTo('App\Class_teacher','staff_id','id');
    }
    public function departments() {
        return $this->belongsTo('App\Staff_department','staff_department_id','id');
    }
     public function academic_years() {
        return $this->belongsTo('App\Academic_year','academic_year_id','id');
    }
     public function staff_types() {
        return $this->belongsTo('App\Staff_type','staff_type_id','id');
    }
     public function staff_departments() {
        return $this->belongsTo('App\Staff_department', 'staff_department_id', 'id');
    }
    
}
