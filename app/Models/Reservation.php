<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'user_id',
    'pet_id',
    'start_date',
    'end_date',
    'status'
];

// Relación con usuario
public function user()
{
    return $this->belongsTo(User::class);
}

// Relación con mascota
public function pet()
{
    return $this->belongsTo(Pet::class);
}

public function resource()
{
    return $this->belongsTo(Resource::class);
}
}
