<?php

namespace Database\Factories;

use App\Models\Pet;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Pet>
 */
class PetFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
          return [
            'owner_user_id' => 1, // de momento fijo

            'name' => fake()->firstName(),

            // SOLO PERROS
            'species' => 'dog',

            'breed' => fake()->randomElement([
                'Labrador',
                'Bulldog',
                'Pastor Alemán',
                'Beagle',
                'Poodle'
            ]),

            'size' => fake()->randomElement([
                'toy', 'small', 'medium', 'large'
            ]),

            'birth_date' => fake()->date(),

            'care_notes' => fake()->sentence(),

            'photo_path' => null,
        ];
    }
}
