<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle_route extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function stops() {
        return $this->belongsTo('App\Route_stop', 'route_id', 'id');
    }

}
