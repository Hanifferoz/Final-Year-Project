<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    public function Fid(){
        return $this->belongsTo('App\Airport','fid','id');
    }
    public function Tid(){
        return $this->belongsTo('App\Airport','tid','id');
    }
}
