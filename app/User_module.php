<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_module extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public function modules() {
        return $this->belongsTo('App\Module', 'module_id', 'id')->orderBy('rank', 'asc');
    }

    public function user_types() {
        return $this->belongsTo('App\User_type', 'user_type_id', 'id');
    }

}
