<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_quantity extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    public function user_logins() {
        return $this->belongsTo('App\User_login', 'created_user_id', 'id');
    }
    public function product_quantity() {
        return $this->belongsTo('App\Product','product_id','id');
    }

}
