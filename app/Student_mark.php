<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_mark extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function exams() {
        return $this->belongsTo('App\Exam', 'exam_id', 'id');
    }
     public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    public function class_exams() {
        return $this->belongsTo('App\Class_exam', 'exam_id', 'id');
    }
    public function subjects() {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }
     public function schedule_exams() {
        return $this->belongsTo('App\Schedule_exam', 'schedule_exam_id', 'id');
    }

}
