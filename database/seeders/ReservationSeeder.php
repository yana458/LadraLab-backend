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
        'user_id' => 1,
        'pet_id' => 1,
        'start_date' => '2026-05-01',
        'end_date' => '2026-05-05',
        'status' => 'pending'
    ]);
    }
}
