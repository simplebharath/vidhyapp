<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_transport_fee extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function fee_types() {
        return $this->belongsTo('App\Fee_type', 'fee_type_id', 'id');
    }

    public function fees() {
        return $this->belongsTo('App\Fee', 'fee_id', 'id');
    }

    public function transport_fees() {
        return $this->belongsTo('App\Transport_fee', 'transport_fee_id', 'id');
    }
     public function route_stops() {
        return $this->belongsTo('App\Route_stop', 'stop_id', 'id');
    }
     public function routes() {
        return $this->belongsTo('App\Vehicle_route', 'route_id', 'id');
    }

}
