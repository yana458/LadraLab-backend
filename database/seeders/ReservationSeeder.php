<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Reservation;
use App\Models\Pet;
use App\Models\Service;
use App\Models\Resource;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pets = Pet::all();

        $hotel = Service::where(
            'booking_mode',
            'date_range'
        )->first();

        $daycare = Service::where(
            'booking_mode',
            'single_day'
        )->first();

        $training = Service::where(
            'name',
            'Entrenamiento'
        )->first();

        foreach ($pets as $pet) {

            // HOTEL
            Reservation::create([
                'client_user_id' => $pet->owner_user_id,
                'pet_id' => $pet->id,
                'service_id' => $hotel->id,
                'resource_id' => Resource::inRandomOrder()->first()?->id,
                'start_at' => now()->addDays(rand(1, 5)),
                'end_at' => now()->addDays(rand(6, 10)),
                'status' => 'confirmed',
                'notes' => 'Reserva de alojamiento',
            ]);

            // GUARDERÍA
            Reservation::create([
                'client_user_id' => $pet->owner_user_id,
                'pet_id' => $pet->id,
                'service_id' => $daycare->id,
                'resource_id' => Resource::inRandomOrder()->first()?->id,
                'start_at' => now()->addDays(rand(1, 10)),
                'end_at' => now()->addDays(rand(1, 10)),
                'status' => 'pending',
                'notes' => 'Reserva guardería',
            ]);

            // TIME SLOT
            if ($training) {

                Reservation::create([
                    'client_user_id' => $pet->owner_user_id,
                    'pet_id' => $pet->id,
                    'service_id' => $training->id,
                    'resource_id' => null,
                    'start_at' => now()
                        ->addDays(rand(2, 8))
                        ->setHour(16)
                        ->setMinute(0),

                    'end_at' => now()
                        ->addDays(rand(2, 8))
                        ->setHour(17)
                        ->setMinute(0),

                    'status' => 'confirmed',
                    'notes' => 'Sesión de entrenamiento',
                ]);
            }
        }
    }
}
