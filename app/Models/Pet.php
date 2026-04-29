<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pet extends Model
{
    use HasFactory;
    protected $fillable = [
    'owner_user_id',
    'name',
    'species',
    'breed',
    'size',
    'birth_date',
    'care_notes',
    'photo_path'
];


// Relación: una mascota pertenece a un usuario
public function owner()
{
    return $this->belongsTo(User::class, 'owner_user_id');
}

// Relación: una mascota tiene varias reservas
public function reservations()
{
    return $this->hasMany(Reservation::class);
}

}

