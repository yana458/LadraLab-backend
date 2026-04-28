<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pet extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'species',
    'breed',
    'age'
];

// Relación: una mascota pertenece a un usuario
public function user()
{
    return $this->belongsTo(User::class);
}

// Relación: una mascota tiene varias reservas
public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}

