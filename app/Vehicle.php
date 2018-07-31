<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
 public function vehicle_type() {
        return $this->belongsTo('App\Vehicle_type','vehicle_type_id','id');
    }
}
