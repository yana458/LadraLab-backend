<?php

namespace Database\Seeders;

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
            'name' => 'Suite Luna',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'medium',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Suite Thor',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'large',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Patio Nala',
            'type' => 'yard',
            'zone' => 'daycare',
            'size_group' => 'medium',
            'capacity' => 8,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Patio Rocky',
            'type' => 'yard',
            'zone' => 'daycare',
            'size_group' => 'large',
            'capacity' => 5,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Sala Calma',
            'type' => 'room',
            'zone' => 'support',
            'size_group' => 'all',
            'capacity' => 2,
            'status' => 'active',
        ]);
    }
}
