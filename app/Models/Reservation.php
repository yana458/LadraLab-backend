<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
    'client_user_id',
    'pet_id',
    'service_id',
    'resource_id',
    'start_at',
    'end_at',
    'status',
    'notes'
];

// Cliente
public function client()
{
    return $this->belongsTo(User::class, 'client_user_id');
}

// Mascota
public function pet()
{
    return $this->belongsTo(Pet::class);
}

// Recurso
public function resource()
{
    return $this->belongsTo(Resource::class);
}

//servicio
public function service()
{
    return $this->belongsTo(Service::class);
}

//reportes
public function dailyReports()
{
    return $this->hasMany(DailyReport::class);
}
}
