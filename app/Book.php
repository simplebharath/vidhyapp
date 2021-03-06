<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
     public function staff_types() {
        return $this->belongsTo('App\Staff_type', 'staff_type_id', 'id');
    }

public function departments() {
        return $this->belongsTo('App\Staff_department','staff_department_id','id');
    }
}
