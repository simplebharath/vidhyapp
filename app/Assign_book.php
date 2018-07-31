<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assign_book extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public function staff_types() {
        return $this->belongsTo('App\Staff_type', 'staff_type_id', 'id');
    }

    public function departments() {
        return $this->belongsTo('App\Staff_department', 'staff_department_id', 'id');
    }

    public function class_sections() {
        return $this->belongsTo('App\Class_section', 'class_section_id', 'id');
    }

    public function sections() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }

    public function classes() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }

    public function student() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function book() {
        return $this->belongsTo('App\Book', 'book_id', 'id');
    }

    public function return_book() {
        return $this->belongsTo('App\Return_book', 'assign_book_id', 'id');
    }

}
