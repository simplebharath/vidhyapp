<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_driver extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
 public function user_type() {
        return $this->belongsTo('App\User_type', 'user_type_id', 'id');
    }
     public function vehicle_type() {
        return $this->belongsTo('App\Vehicle_type', 'vehicle_type_id', 'id');
    }
    
    public function vehicle() {
        return $this->belongsTo('App\Vehicle', 'vehicle_id', 'id');
    }
     
    public function routes() {
        return $this->belongsTo('App\Vehicle_route', 'route_id', 'id');
    }
     public function staff() {
        return $this->belongsTo('App\Staff', 'staff_id', 'id');
    }
}
