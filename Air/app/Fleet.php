<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{
    public function FlightGroup(){
        return $this->belongsTo('App\FlightGroup','fid','id');
    }
}
