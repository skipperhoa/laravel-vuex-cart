<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    //
    public function products(){
        return $this->hasMany('App\products');
    }
}
