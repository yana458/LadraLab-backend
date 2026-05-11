<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // CLIENTE DEMO
        User::create([
            'name' => 'Ana Tutor',
            'email' => 'cliente@ladralab.com',
            'password' => 'password',
            'phone' => '+34 622 381 547',
            'role' => 'client',
            'is_active' => true,
            'last_login_at' => now(),
        ]);

        // STAFF DEMO
        User::create([
            'name' => 'Sergio Staff',
            'email' => 'staff@ladralab.com',
            'password' => 'password',
            'phone' => '+34 600 111 222',
            'role' => 'staff',
            'is_active' => true,
            'last_login_at' => now(),
        ]);

        // ADMIN DEMO
        User::create([
            'name' => 'Alicia Admin',
            'email' => 'admin@ladralab.com',
            'password' => 'password',
            'phone' => '+34 600 333 444',
            'role' => 'admin',
            'is_active' => true,
            'last_login_at' => now(),
        ]);

        // CLIENTES EXTRA
        User::factory(8)->create([
            'role' => 'client',
        ]);

        // STAFF EXTRA
        User::factory(2)->create([
            'role' => 'staff',
        ]);
    }
}
