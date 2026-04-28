<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pet;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pet::create([
        'user_id' => 1,
        'name' => 'Bobby',
        'species' => 'Perro',
        'breed' => 'Labrador',
        'age' => 3,
    ]);

    Pet::create([
        'user_id' => 1,
        'name' => 'Misu',
        'species' => 'Gato',
        'breed' => 'Siames',
        'age' => 2,
    ]);
    }
}
