<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'user_name',
        'space_id',
        'start_time',
        'end_time',
        'status',
    ];
}
