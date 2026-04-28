<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Resource;

class ResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Resource::create([
        'name' => 'Habitación 1',
        'type' => 'Habitación',
        'available' => true
    ]);

    Resource::create([
        'name' => 'Jaula 1',
        'type' => 'Jaula',
        'available' => true
    ]);
    }
}
