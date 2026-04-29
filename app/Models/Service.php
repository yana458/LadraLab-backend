<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'base_price',
        'booking_mode',
        'default_start_time',
        'default_end_time',
        'duration_minutes',
        'slot_interval_min',
        'is_active'
    ];
}
