<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model {

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

}
