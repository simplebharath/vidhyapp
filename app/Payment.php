<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    
     public function class_fees() {
        return $this->belongsTo('App\Fee', 'fee_id', 'id');
    }
     public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    
    
}
