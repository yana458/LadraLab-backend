<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\DailyReport;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reports = DailyReport::all();

        foreach ($reports as $report) {

            Media::create([
                'daily_report_id' => $report->id,
                'file_path' => 'daily-reports/demo-report.jpg',
                'file_type' => 'image',
                'uploaded_at' => now(),
            ]);
        }
    }
}
