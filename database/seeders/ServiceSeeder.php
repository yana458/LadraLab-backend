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
    ]);

    Service::create([
        'name' => 'Guardería',
        'base_price' => 10,
        'booking_mode' => 'single_day',
    ]);
}
    }

