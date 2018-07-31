<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee_discount extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function fees() {
        return $this->belongsTo('App\Fee', 'fee_id', 'id');
    }

    public function students() {
        return $this->belongsTo('App\Student', 'student_id', 'id');
    }

    public function class_sections() {
        return $this->belongsTo('App\Class_section', 'class_section_id', 'id');
    }

}
