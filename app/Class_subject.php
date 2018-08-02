<?php

namespace App;

use App\Models\BaseModel;

class Class_subject extends BaseModel {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public static function classSubjectTabs() {
        $tabs = ["add-class-subject", "view-class-subjects", "edit-class-subject"];
        return $tabs;
    }
    public static function classScheduleTabs() {
        $tabs = ["class-schedule", "view-class-schedule"];
        return $tabs;
    }
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public function classes() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }

    public function sections() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }

    public function subjects() {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

    public function days() {
        return $this->belongsTo('App\Day', 'day_id', 'id');
    }

    public function timings() {
        return $this->belongsTo('App\Institute_timing', 'institute_timing_id', 'id');
    }

    public function staffs() {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

}
