<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
 public function expenses() {
        return $this->belongsTo('App\Expense_type','expense_type_id','id');
    }
}
