<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Driver extends Model
{
    use SoftDeletes;

    protected $table = 'drivers';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'company', 'phone', 'status'
    ];

    public function scopeAvailable($query){
        return $query->where('status', 1);
    }
}
