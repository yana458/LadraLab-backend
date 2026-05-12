<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DailyReport;
use App\Models\Reservation;

class DailyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservations = Reservation::whereHas('service', function ($query) {
            $query->whereIn('booking_mode', [
                'date_range',
                'single_day'
            ]);
        })->take(3)->get();

        foreach ($reservations as $reservation) {

            // DÍA 1
            DailyReport::create([
                'reservation_id' => $reservation->id,
                'report_date' => now()->subDays(2)->toDateString(),
                'status' => 'published',
                'published_at' => now()->subDays(2),
                'food_done' => true,
                'walk_done' => true,
                'rest_done' => true,
                'hygiene_done' => true,
                'medication_done' => false,
                'play_done' => true,
                'summary' => 'Primer día tranquilo y buena adaptación.',
                'observations' => 'Se mostró sociable.',
            ]);

            // DÍA 2
            DailyReport::create([
                'reservation_id' => $reservation->id,
                'report_date' => now()->subDay()->toDateString(),
                'status' => 'published',
                'published_at' => now()->subDay(),
                'food_done' => true,
                'walk_done' => true,
                'rest_done' => true,
                'hygiene_done' => true,
                'medication_done' => false,
                'play_done' => true,
                'summary' => 'Muy activo durante los paseos.',
                'observations' => 'Jugó mucho con otros perros.',
            ]);

            // DÍA 3
            DailyReport::create([
                'reservation_id' => $reservation->id,
                'report_date' => now()->toDateString(),
                'status' => 'draft',

                'food_done' => true,
                'walk_done' => false,
                'rest_done' => true,
                'hygiene_done' => false,
                'medication_done' => false,
                'play_done' => true,
                'summary' => 'Pendiente de publicar.',
                'observations' => 'Aún completando checklist.',
            ]);
        }
    }
}