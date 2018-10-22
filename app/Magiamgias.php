<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Magiamgias extends Model
{
    public function donhang(){
        return $this->hasMany('App\Donhangs');
    }
}
