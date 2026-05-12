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
        /*
        |--------------------------------------------------------------------------
        | HOTEL SUITES
        |--------------------------------------------------------------------------
        */

        Resource::create([
            'name' => 'Suite Mareas',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'small',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Suite Brujas',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'large',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Suite Perlas',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'toy',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Suite Algodón',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'medium',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Suite Caramelo',
            'type' => 'kennel',
            'zone' => 'hotel',
            'size_group' => 'medium',
            'capacity' => 1,
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | PATIOS
        |--------------------------------------------------------------------------
        */

        Resource::create([
            'name' => 'Patio Pastos',
            'type' => 'yard',
            'zone' => 'daycare',
            'size_group' => 'medium',
            'capacity' => 8,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Patio Bellotas',
            'type' => 'yard',
            'zone' => 'daycare',
            'size_group' => 'small',
            'capacity' => 6,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Patio Esmeralda',
            'type' => 'yard',
            'zone' => 'daycare',
            'size_group' => 'large',
            'capacity' => 5,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Patio Chispitas',
            'type' => 'yard',
            'zone' => 'daycare',
            'size_group' => 'toy',
            'capacity' => 4,
            'status' => 'active',
        ]);

        /*
        |--------------------------------------------------------------------------
        | SALAS DE APOYO
        |--------------------------------------------------------------------------
        */

        Resource::create([
            'name' => 'Sala Calma',
            'type' => 'room',
            'zone' => 'support',
            'size_group' => 'all',
            'capacity' => 2,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Sala VetCare',
            'type' => 'room',
            'zone' => 'support',
            'size_group' => 'all',
            'capacity' => 1,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Sala Relax',
            'type' => 'room',
            'zone' => 'support',
            'size_group' => 'small',
            'capacity' => 2,
            'status' => 'active',
        ]);

        Resource::create([
            'name' => 'Sala Senior',
            'type' => 'room',
            'zone' => 'support',
            'size_group' => 'large',
            'capacity' => 2,
            'status' => 'active',
        ]);
    }
}
