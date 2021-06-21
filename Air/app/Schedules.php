<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedules extends Model
{
    //
    public function Route(){
        return $this->belongsTo('App\Routes','rid','id');
    }
    public function Fleet(){
        return $this->belongsTo('App\Fleet','fid','id');
    }
}
