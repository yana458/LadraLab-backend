<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Hotel Canino',
            'description' => 'Alojamiento para perros',
            'base_price' => 20,
            'booking_mode' => 'date_range',
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Guardería',
            'description' => 'Servicio de guardería de día',
            'base_price' => 10,
            'booking_mode' => 'single_day',
            'default_start_time' => '09:00',
            'default_end_time' => '18:00',
            'is_active' => true,
        ]);

        Service::create([
            'name' => 'Entrenamiento',
            'description' => 'Sesiones básicas de obediencia',
            'base_price' => 35,
            'booking_mode' => 'time_slot',
            'default_start_time' => '09:00',
            'default_end_time' => '18:00',
            'duration_minutes' => 60,
            'slot_interval_min' => 60,
            'is_active' => true,
        ]);
    }
}

