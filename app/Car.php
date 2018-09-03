<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{

    public function mileage_histories(){
        return $this->hasMany('App\MileageHistory','car_id','id');
    }
}
