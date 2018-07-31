<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment_record extends Model {
    
     public function class_fees() {
        return $this->belongsTo('App\Fee', 'fee_id', 'id');
    }
     public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    public function fees() {
        return $this->belongsTo('App\Fee', 'fee_id', 'id');
    }
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    
    
}
