<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function exams() {
        return $this->hasMany('App\Class_exam', 'exam_id', 'id');
    }

}
