<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event_album extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
public function event_title() {
        return $this->belongsTo('App\Event_title','event_title_id','id');
    }
    public function events() {
        return $this->belongsTo('App\Event','event_id','id');
    }
}
