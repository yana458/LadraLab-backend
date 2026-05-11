<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pet;
use App\Models\User;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CLIENTES
        $clients = User::where('role', 'client')->get();

        // CLIENTE DEMO
        $demoClient = User::where(
            'email',
            'cliente@ladralab.com'
        )->first();

        // MASCOTAS DEMO
        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Luna',
            'species' => 'dog',
            'breed' => 'Golden Retriever',
            'size' => 'large',
            'birth_date' => '2022-03-10',
            'care_notes' => 'Muy tranquila y cariñosa.',
            'photo_path' => 'pets/luna.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Milo',
            'species' => 'dog',
            'breed' => 'Beagle',
            'size' => 'medium',
            'birth_date' => '2021-08-15',
            'care_notes' => 'Muy activo y juguetón.',
            'photo_path' => 'pets/milo.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Nala',
            'species' => 'dog',
            'breed' => 'Border Collie',
            'size' => 'medium',
            'birth_date' => '2020-05-20',
            'care_notes' => 'Necesita bastante ejercicio.',
            'photo_path' => 'pets/nala.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Thor',
            'species' => 'dog',
            'breed' => 'Pastor Alemán',
            'size' => 'large',
            'birth_date' => '2019-11-01',
            'care_notes' => 'Protector pero sociable.',
            'photo_path' => 'pets/thor.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Kira',
            'species' => 'dog',
            'breed' => 'Bulldog Francés',
            'size' => 'small',
            'birth_date' => '2023-01-12',
            'care_notes' => 'Muy tranquila y dormilona.',
            'photo_path' => 'pets/kira.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Mafito',
            'species' => 'dog',
            'breed' => 'Yorkshire Terrier',
            'size' => 'toy',
            'birth_date' => '2022-09-03',
            'care_notes' => 'Le gusta pollito y pasear',
            'photo_path' => 'pets/mafito.jpg',
        ]);

        // MASCOTAS ALEATORIAS
        foreach ($clients as $client) {

            Pet::factory(rand(1, 3))->create([
                'owner_user_id' => $client->id,
            ]);
        }
    }
}
