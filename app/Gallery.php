<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model {

    protected $guarded = ['id'];
    protected $primaryKey = 'id';

   

    public function albums() {
        return $this->belongsTo('App\Album', 'album_id', 'id');
    }

}
