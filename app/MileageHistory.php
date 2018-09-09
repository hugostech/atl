<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MileageHistory extends Model
{
    protected $table = 'mileage_histories';
    protected $fillable = [
        'editor','odometer_reading','car_id'
    ];
}
