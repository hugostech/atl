<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable=[
        'odometer_reading','plate','no_of_seats','tyreinfo','year_of_manufacture','cof',
        'reg','service','ruc','make','model','vin','engine_no','main_colour'
    ];
    public function mileage_histories(){
        return $this->hasMany('App\MileageHistory','car_id','id');
    }

    public function needService(){
        return $this->service-$this->odometer_reading<1000;
    }

    public function needCof(){
        $cof = Carbon::parse($this->cof)->subMonth();
        return Carbon::now()->gt($cof);
    }

    public function needRuc(){
        return $this->ruc-$this->odometer_reading<1000;
    }

    public function needReg(){
        $reg = Carbon::parse($this->reg)->subMonth();
        return Carbon::now()->gt($reg);
    }
}
