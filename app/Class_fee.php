<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Class_fee extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function fee_types() {
        return $this->belongsTo('App\Fee_type', 'fee_type_id', 'id');
    }

    public function fees() {
        return $this->belongsTo('App\Fee', 'fee_id', 'id');
    }

    public function class_sections() {
        return $this->belongsTo('App\Class_section', 'class_section_id', 'id');
    }
    

    public function fee_feetypes() {
        return $this->belongsTo('App\Assign_feetype', 'assign_feetype_id', 'id');
    }

}
