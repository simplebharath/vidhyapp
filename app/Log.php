<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'user_login_id', 'id');
    }

}
