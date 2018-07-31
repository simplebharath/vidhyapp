<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function classes() {
        return $this->belongsTo('App\Classes', 'class_id', 'id');
    }
    public function sections() {
        return $this->belongsTo('App\Section', 'section_id', 'id');
    }
    public function subjects() {
        return $this->belongsTo('App\Subject', 'subject_id', 'id');
    }

}
