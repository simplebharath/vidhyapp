<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_attendance extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function attendance_types() {
        return $this->belongsTo('App\Attendance_type', 'attendance_type_id', 'id');
    }

    public function class_sections() {
        return $this->belongsTo('App\Class_section', 'class_section_id', 'id');
    }

    public function subjects() {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

}
