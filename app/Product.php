<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function products() {
        return $this->hasMany('App\Product_quantity', 'product_id', 'id');
    }
}
