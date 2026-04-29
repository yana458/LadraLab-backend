<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
    'name',
    'type',
    'zone',
    'size_group',
    'capacity',
    'status'
];

// Relación con reservas
public function reservations()
{
    return $this->hasMany(Reservation::class);
}
}
