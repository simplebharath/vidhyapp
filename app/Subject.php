<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function subjectTabs() {
        $this->tabs = ["add-subject", "view-subjects", "edit-subject"];
        return $this->tabs;
    }
}
