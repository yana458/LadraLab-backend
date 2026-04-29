<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DailyReport;

class DailyReportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DailyReport::create([
        'reservation_id' => 1,
        'report_date' => now(),
        'food_done' => true,
        'walk_done' => true,
        'summary' => 'Día tranquilo'
    ]);
    }
}
