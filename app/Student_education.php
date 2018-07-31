<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_education extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'user_login_id', 'id');
    }

    public function user_types() {
        return $this->belongsTo('App\User_type', 'user_type_id', 'id');
    }

    public function classes() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }

    public function sections() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }
    public function days() {
        return $this->belongsTo('App\Day', 'day_id', 'id');
    }

    public function class_sections() {
        return $this->belongsTo('App\Class_section', 'class_section_id', 'id');
    }

    public function academic_years() {
        return $this->belongsTo('App\Academic_year', 'academic_year_id', 'id');
    }
     public function student_types() {
        return $this->belongsTo('App\Student_type', 'student_type_id', 'id');
    }
}
