<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_remark extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }
    public function subjects() {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

}
