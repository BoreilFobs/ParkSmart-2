<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParkingZone extends Model
{
    protected $fillable = [
        'name',
        'hourly_rate',
        'total_spaces',
    ];
}
