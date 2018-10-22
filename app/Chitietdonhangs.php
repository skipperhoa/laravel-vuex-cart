<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chitietdonhangs extends Model
{
    public function donhang(){
        return $this->belongsTo('App\Donhangs');
    }
}
