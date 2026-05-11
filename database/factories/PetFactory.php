<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Pet>
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
        $names = [
            'Nala',
            'Rocky',
            'Kira',
            'Thor',
            'Coco',
            'Bruno',
            'Chispa',
            'Nube',
            'Toby',
            'Lola'
        ];

        return [
            'owner_user_id' => User::where(
                'role',
                'client'
            )->inRandomOrder()->first()?->id,

            'name' => fake()->randomElement($names),

            'species' => 'dog',

            'breed' => fake()->randomElement([
                'Labrador',
                'Border Collie',
                'Bulldog Francés',
                'Pastor Alemán',
                'Beagle',
                'Golden Retriever',
                'Yorkshire Terrier',
            ]),

            'size' => fake()->randomElement([
                'toy',
                'small',
                'medium',
                'large'
            ]),

            'birth_date' => fake()->date(),

            'care_notes' => fake()->sentence(),

            'photo_path' => fake()->randomElement([
                'pets/demo-1.jpg',
                'pets/demo-2.jpg',
                'pets/demo-3.jpg',
                'pets/demo-4.jpg',
            ]),
        ];
    }
}
