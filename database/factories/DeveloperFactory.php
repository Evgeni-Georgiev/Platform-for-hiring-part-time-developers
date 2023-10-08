<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Developer>
 */
class DeveloperFactory extends Factory
{

    protected $model = Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('##########'),
            'location' => fake()->word(),
            'price_per_hour' => fake()->numberBetween(20, 100),
            'technology' => fake()->randomElement(["JavaScript", "Java", ".NET", "Flutter", "Python", "PHP"]),
            'description' => fake()->text(),
            'years_of_experience' => fake()->numberBetween(1, 10),
            'native_language' => fake()->randomElement(["English", "Serbian", "Bulgarian"]),
            'linkedin_profile_link' => fake()->url(),
        ];
    }
}
