<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_login extends Model
{
    protected $table = 'user_logins';
    protected $fillable = ['username', 'password'];
    protected $guarded = ['id'];
    protected $primaryKey = 'id';
}
