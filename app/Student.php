<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

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

    public function joined_classes() {
        return $this->belongsTo('App\Classes', 'joined_class_id', 'id');
    }

    public function joined_sections() {
        return $this->belongsTo('App\Section', 'joined_section_id', 'id');
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

    public function joined_academic_years() {
        return $this->belongsTo('App\Academic_year', 'student_academic_year_id', 'id');
    }

    public function student_types() {
        return $this->belongsTo('App\Student_type', 'student_type_id', 'id');
    }

    public function routes() {
        return $this->belongsTo('App\Vehicle_route', 'route_id', 'id');
    }

    public function stops() {
        return $this->belongsTo('App\Route_stop', 'stop_id', 'id');
    }
     public function parents() {
        return $this->belongsTo('App\Parent_detail', 'student_id', 'id');
    }

}
