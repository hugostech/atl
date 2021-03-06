<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Car extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'odometer_reading', 'plate', 'no_of_seats', 'tyreinfo', 'year_of_manufacture', 'cof',
        'reg', 'service', 'ruc', 'make', 'model', 'vin', 'engine_no', 'main_colour', 'last_service_date',
        'hubemeter_reading', 'company', 'last_editor', 'vehicle_type', 'hours', 'service_hours',
        'status'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('status', function (Builder $builder) {
            $builder->where('status', 1);
        });
    }

    public function getImageAttribute($value){
        if (empty($value)){
            return asset('logos/Mercedes-Benz-logo.png');
        }else{
            return asset(Storage::url('avatar/'.$value));
        }
    }

    public function mileage_histories()
    {
        return $this->hasMany('App\MileageHistory', 'car_id', 'id');
    }

    public function needService()
    {
        if ($this->vehicle_type == "Digger Vehicle") {
            $reminder = $this->service_hours - $this->hours;
            if (!empty($reminder)) {
                return $reminder;
            } else {
                return false;
            }
        } else {
            if (!empty($this->service)) {
                if ($this->odometer_reading > 0) {
                    return $this->service - $this->odometer_reading;
                } elseif ($this->hubemeter_reading > 0) {
                    return $this->service - $this->hubemeter_reading;
                } else {
                    Throw new \Exception('Setting error, missing odometer reading or hubemeter reading');
                }
            } else {
                return false;
            }
        }
    }

    public function needCof()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->cof), false);
    }

    public function needRuc()
    {
        if ($this->ruc > 0) {
            if ($this->hubemeter_reading > 0) {
                return $this->ruc - $this->hubemeter_reading;
            } elseif ($this->odometer_reading > 0) {
                return $this->ruc - $this->odometer_reading;
            } else {
                Throw new \Exception('Setting error, missing odometer reading or hubemeter reading');
            }
        } else {
            return false;
        }
    }

    public function needReg()
    {
        return Carbon::now()->diffInDays(Carbon::parse($this->reg), false);
    }

    public function lastEditor()
    {
        return $this->belongsTo('App\User', 'last_editor');
    }

    public function log_car_issue($error_codes)
    {

    }

    public function scopeTypeCar($query){
        return $query->where('vehicle_type', 'Vehicle');
    }

    public function scopeTypeDigger($query){
        return $query->where('vehicle_type', 'Digger Vehicle');
    }

    public function isDigger(){
        return $this->vehicle_type == 'Digger Vehicle';
    }

    public function getTemplate($isEdit=false){
        $template = 'car.';
        switch ($this->vehicle_type){
            case 'Vehicle':
                $template .= $isEdit?'edit':'new';
                break;
            case 'Digger Vehicle':
                $template .= $isEdit?'editdigger':'newdigger';
                break;
            case 'Roller':
                $template .= $isEdit?'editroller':'newroller';
                break;
            case 'Compactor':
                $template .= $isEdit?'editcompactor':'newcompactor';
                break;
        }
        return $template;


    }
}
