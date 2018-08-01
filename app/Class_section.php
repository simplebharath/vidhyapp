<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_section extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function classSectionTabs() {
        $this->tabs = ["add-class-section", "view-class-sections", "edit-class-section"];
        return $this->tabs;
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
