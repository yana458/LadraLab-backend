<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::factory()->create([
            'name' => 'Cliente Demo',
            'email' => 'cliente@ladralab.com',
            'role' => 'client',
        ]);

        User::factory()->create([
            'name' => 'Staff Demo',
            'email' => 'staff@ladralab.com',
            'role' => 'staff',
        ]);

        User::factory()->create([
            'name' => 'Admin Demo',
            'email' => 'admin@ladralab.com',
            'role' => 'admin',
        ]);

        User::factory(3)->create([
            'role' => 'client'
        ]);

        User::factory(1)->create([
            'role' => 'staff'
        ]);


        $this->call([
            PetSeeder::class,
            ResourceSeeder::class,
            ServiceSeeder::class,
            ReservationSeeder::class,
            DailyReportSeeder::class,
            MediaSeeder::class,
        ]);
    }
}
