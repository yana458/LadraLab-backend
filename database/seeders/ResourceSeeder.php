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
        'name' => 'Kennel 1',
        'type' => 'kennel',
        'zone' => 'hotel',
        'size_group' => 'medium',
        'capacity' => 1,
        'status' => 'active',
    ]);

    Resource::create([
        'name' => 'Patio 1',
        'type' => 'yard',
        'zone' => 'daycare',
        'size_group' => 'large',
        'capacity' => 5,
        'status' => 'active',
    ]);

    Resource::create([
        'name' => 'Sala apoyo',
        'type' => 'room',
        'zone' => 'support',
        'size_group' => 'all',
        'capacity' => 2,
        'status' => 'active',
    ]);
    }
}
