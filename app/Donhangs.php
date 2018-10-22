<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donhangs extends Model
{

    public function user(){
        return $this->belongsTo('App\User');        
    }

    public function chitietdonhang(){
        return $this->hasMany('App\Chitietdonhangs');
    }

    public function magiamgias(){
        return $this->belongsTo('App\Magiamgias');
    }
    
}
