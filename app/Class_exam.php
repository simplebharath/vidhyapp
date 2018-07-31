<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_exam extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
 public function exams() {
        return $this->belongsTo('App\Exam','exam_id','id');
    }
     public function class_sections() {
        return $this->belongsTo('App\Class_section','class_section_id','id');
    }
     public function sections() {
        return $this->belongsTo('App\Section','section_id','id');
    }
     public function classes() {
        return $this->belongsTo('App\Classes','class_id','id');
    }
}
