<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Pet;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Obtener una mascota existente
    $pet = Pet::inRandomOrder()->first();
    // Crear reserva coherente
    Reservation::create([
        // CLIENTE = OWNER REAL DE LA MASCOTA
        'client_user_id' => $pet->owner_user_id,
        // MASCOTA
        'pet_id' => $pet->id,
        // Servicio demo
        'service_id' => 1,
        // Recurso opcional
        'resource_id' => null,
        // Fechas
        'start_at' => '2026-05-01 10:00:00',
        'end_at' => '2026-05-05 10:00:00',
        // Estado
        'status' => 'pending',
        // Notas
        'notes' => 'Primera reserva'
    ]);
}
}
