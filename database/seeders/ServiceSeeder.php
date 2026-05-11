<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Guardería de día',
            'description' => 'Estancia de día con supervisión y juego.',
            'base_price' => 18,
            'booking_mode' => 'single_day',
            'default_start_time' => '09:00',
            'default_end_time' => '18:00',
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Hotel canino',
            'description' => 'Alojamiento con cuidados diarios.',
            'base_price' => 32,
            'booking_mode' => 'date_range',
            'default_start_time' => '10:00',
            'default_end_time' => '17:00',
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Baño y puesta a punto',
            'description' => 'Servicio de higiene con cita.',
            'base_price' => 22,
            'booking_mode' => 'time_slot',
            'default_start_time' => '10:00',
            'default_end_time' => '14:00',
            'duration_minutes' => 60,
            'slot_interval_min' => 60,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Entrenamiento',
            'description' => 'Sesiones individuales programadas.',
            'base_price' => 30,
            'booking_mode' => 'time_slot',
            'default_start_time' => '16:00',
            'default_end_time' => '20:00',
            'duration_minutes' => 60,
            'slot_interval_min' => 60,
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Paseo individual',
            'description' => 'Paseos controlados individuales.',
            'base_price' => 12,
            'booking_mode' => 'time_slot',
            'default_start_time' => '11:00',
            'default_end_time' => '13:00',
            'duration_minutes' => 45,
            'slot_interval_min' => 60,
            'is_active' => true,
        ]);
    }
}

