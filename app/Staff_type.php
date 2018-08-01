<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff_type extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    
     public function departments() {
        return $this->hasMany('App\Staff_department', 'staff_type_id', 'id');
    }
    
}
