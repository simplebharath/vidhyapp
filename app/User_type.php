<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_type extends Model {

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function staff() {
        return $this->hasMany('App\Staff', 'user_type_id', 'id');
    }
     public function students() {
        return $this->hasMany('App\Student', 'user_type_id', 'id');
    }
     public function parents() {
        return $this->hasMany('App\Parent_detail', 'user_type_id', 'id');
    }

}
