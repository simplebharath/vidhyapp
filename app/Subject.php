<?php

namespace App;

use App\Models\BaseModel;

class Subject extends BaseModel {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public static function subjectTabs() {
        $tabs = ["add-subject", "view-subjects", "edit-subject"];
        return $tabs;
    }
}
