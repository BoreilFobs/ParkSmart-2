<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_name',
        'spot',
        'plate',
        'start_time',
        'end_time',
        'total',
    ];
}
