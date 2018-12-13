<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MileageHistory extends Model
{
    protected $table = 'mileage_histories';
    protected $fillable = [
        'editor','odometer_reading','car_id','driver_id','date','group_code','cof_due_date','cof','total_fuel',
        'hubmeter_reading','body','mechanics','hygiene',
    ];
}
