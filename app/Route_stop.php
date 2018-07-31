<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Route_stop extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
public function vehicle_route() {
        return $this->belongsTo('App\Vehicle_route', 'route_id', 'id');
    }
}
