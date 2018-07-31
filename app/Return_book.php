<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Return_book extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }

    public function assign_book() {
        return $this->belongsTo('App\Assign_book', 'assign_book_id', 'id');
    }

}
