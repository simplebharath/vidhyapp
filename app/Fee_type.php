<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fee_type extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

}
