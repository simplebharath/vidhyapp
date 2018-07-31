<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade_setting extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public function grades() {
        return $this->belongsTo('App\Grade_type', 'grade_type_id', 'id');
    }
    public function percentages() {
        return $this->belongsTo('App\Percentages', 'percentage_id', 'id');
    }
}
 