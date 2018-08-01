<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_teacher extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function classTeacherTabs() {
        $this->tabs = ["add-class-teacher", "view-class-teachers", "edit-class-teacher"];
        return $this->tabs;
    }
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
     public function teachers() {
        return $this->belongsTo('App\Staff','staff_id','id');
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
    public function class_sections() {
        return $this->belongsTo('App\Class_section','class_section_id','id');
    }

}
