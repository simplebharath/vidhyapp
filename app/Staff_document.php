<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Staff_document extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function staff() {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }

}
