<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MileageHistory extends Model
{
    protected $table = 'mileage_histories';
    protected $fillable = [
        'odometer_reading','car_id','driver_id','date','group_code','cof_due_date','total_fuel',
        'hubmeter_reading','body','mechanics','hygiene', 'rego_due_date', 'next_service','ruc'
    ];
}
