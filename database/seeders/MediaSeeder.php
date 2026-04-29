<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Media;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Media::create([
        'daily_report_id' => 1,
        'file_path' => 'images/test.jpg',
        'file_type' => 'image',
        'uploaded_at' => now(),
    ]);
    }
}
