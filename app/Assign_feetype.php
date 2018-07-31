<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign_feetype extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function fees() {
        return $this->belongsTo('App\Fee','fee_id','id');
    }
     public function fee_types() {
        return $this->belongsTo('App\Fee_type','fee_type_id','id');
    }
    
     public function classes() {
    
        return $this->belongsToMany('App\Classes','class_id','id');
    }

}
