<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meter_reading extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function vehicle_driver() {
        return $this->belongsTo('App\Vehicle_driver','vehicle_driver_id','id');
    }
   
}
