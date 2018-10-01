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
        'reg','service','ruc','make','model','vin','engine_no','main_colour','last_service_date',
        'hubemeter_reading','company','last_editor'
    ];
    public function mileage_histories(){
        return $this->hasMany('App\MileageHistory','car_id','id');
    }

    public function needService(){
        if ($this->odometer_reading>0){
            return $this->service-$this->odometer_reading;
        }else{
            return false;
        }

    }

    public function needCof(){
        return Carbon::now()->diffInDays(Carbon::parse($this->cof),false);
    }

    public function needRuc(){
        if ($this->ruc>0){
            if ($this->hubemeter_reading>0){
                return $this->ruc - $this->hubemeter_reading;
            }elseif ($this->odometer_reading>0){
                return $this->ruc - $this->odometer_reading;
            }else{
                Throw new \Exception('Setting error, missing odometer reading or hubemeter reading');
            }
        }else{
            return false;
        }
    }

    public function needReg(){
        return Carbon::now()->diffInDays(Carbon::parse($this->reg),false);
    }

    public function lastEditor(){
        return $this->belongsTo('App\User','last_editor');
    }
}
