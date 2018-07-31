<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Academic_year extends Model
{
    public $fillable = ['from_date','to_date'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
    
    public function users(){
        return $this->belongsTo('App\User_login', 'created_user_id','id');
}
    
}
