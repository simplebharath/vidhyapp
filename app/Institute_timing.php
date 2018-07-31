<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institute_timing extends Model {

    protected $table = 'institute_timings';
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function acadamic_years() {
        return $this->belongsTo('App\Academic_year');
    }
    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

   
}
