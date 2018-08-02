<?php

namespace App;

use App\Models\BaseModel;

class Class_section extends BaseModel {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public static function classSectionTabs() {
        $tabs = ["add-class-section", "view-class-sections", "edit-class-section"];
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

    public function staff() {
        return $this->belongsTo('App\Class_teacher', 'class_section_id', 'id');
    }
    public function students() {
        return $this->hasMany('App\Student', 'class_section_id', 'id');
    }

}
