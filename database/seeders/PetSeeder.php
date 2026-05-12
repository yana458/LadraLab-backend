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

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Coco',
            'species' => 'dog',
            'breed' => 'Caniche',
            'size' => 'small',
            'birth_date' => '2021-06-14',
            'care_notes' => 'Muy sociable y le encanta jugar.',
            'photo_path' => 'pets/coco.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Rocky',
            'species' => 'dog',
            'breed' => 'Labrador',
            'size' => 'large',
            'birth_date' => '2020-09-02',
            'care_notes' => 'Le encantan los paseos largos.',
            'photo_path' => 'pets/rocky.jpg',
        ]);

        Pet::create([
            'owner_user_id' => $demoClient->id,
            'name' => 'Toby',
            'species' => 'dog',
            'breed' => 'Shiba Inu',
            'size' => 'medium',
            'birth_date' => '2022-01-18',
            'care_notes' => 'Muy curioso y activo.',
            'photo_path' => 'pets/toby.jpg',
        ]);
    }
}
