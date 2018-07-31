<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   
   public function user_logins() {
        return $this->belongsTo('App\User_login', 'user_login_id', 'id');
    }
    
    public function user_types() {
        return $this->belongsTo('App\User_type', 'user_type_id', 'id');
    }

}
