<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Migration_student extends Model {

    public function users() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public function student() {
        return $this->belongsTo('App\Student', 'students', 'student_id');
    }

    public function from_classes() {
        return $this->belongsTo('App\Class_section', 'from_class_section_id', 'id');
    }

    public function to_classes() {
        return $this->belongsTo('App\Class_section', 'to_class_section_id', 'id');
    }

    public function from_years() {
        return $this->belongsTo('App\Academic_year', 'from_academic_year_id', 'id');
    }
    public function to_years() {
        return $this->belongsTo('App\Academic_year', 'to_academic_year_id', 'id');
    }

}
