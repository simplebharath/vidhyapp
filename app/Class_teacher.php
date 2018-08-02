<?php

namespace App;
use App\Models\BaseModel;

class Class_teacher extends BaseModel {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public static function classTeacherTabs() {
        $tabs = ["add-class-teacher", "view-class-teachers", "edit-class-teacher"];
        return $tabs;
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
