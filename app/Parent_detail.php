<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parent_detail extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'user_login_id', 'id');
    }

    public function user_types() {
        return $this->belongsTo('App\User_type', 'user_type_id', 'id');
    }

    public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function academic_years() {
        return $this->belongsTo('App\Academic_year', 'academic_year_id', 'id');
    }

}
