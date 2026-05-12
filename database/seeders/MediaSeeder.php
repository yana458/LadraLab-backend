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

        $images = [
            'daily-reports/daily-report-1.jpg',
            'daily-reports/daily-report-2.jpg',
            'daily-reports/daily-report-3.jpg',
            'daily-reports/daily-report-4.jpg',
            'daily-reports/daily-report-5.jpg',
            'daily-reports/daily-report-6.jpg',
        ];

        foreach ($reports as $index => $report) {

            Media::create([
                'daily_report_id' => $report->id,
                'file_path' => $images[$index % count($images)],
                'file_type' => 'image',
                'uploaded_at' => now(),
            ]);
        }
    }
}
