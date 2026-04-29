<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Reservation;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Reservation::create([
        'client_user_id' => 1,
        'pet_id' => 1,
        'service_id' => 1, // placeholder
        'resource_id' => null,
        'start_at' => '2026-05-01 10:00:00',
        'end_at' => '2026-05-05 10:00:00',
        'status' => 'pending',
        'notes' => 'Primera reserva'
    ]);
    }
}
