<?php

namespace Database\Factories;

use App\Models\Developer;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

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

        $filepath = '/storage/developer';
//        $filepath = '/';
        $image = $this->faker->image();
        $imageFile = new File($image);
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'phone' => fake()->numerify('##########'),
            'location' => fake()->word(),
//            'profile_picture' => $this->faker->image($filepath, 360, 480, 'animals', false),
            'profile_picture' => Storage::disk('public')->putFile('developer', $imageFile),
            'price_per_hour' => fake()->numberBetween(20, 100),
            'technology' => fake()->randomElement(["JavaScript", "Java", ".NET", "Flutter", "Python", "PHP"]),
            'description' => fake()->text(),
            'years_of_experience' => fake()->numberBetween(1, 10),
            'native_language' => fake()->randomElement(["English", "Serbian", "Bulgarian"]),
            'linkedin_profile_link' => fake()->url(),
        ];
    }
}
