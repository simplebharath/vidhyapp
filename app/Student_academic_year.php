<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_academic_year extends Model {

    public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    public function class_sections() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

}
