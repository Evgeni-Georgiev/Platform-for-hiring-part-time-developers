<?php

namespace Database\Factories;

use App\Models\Developer;
use App\Models\Hire;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hire>
 */
class HireFactory extends Factory
{

    protected $model = Hire::class;
    protected $fillable = [
        'developer_id',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $developer_id = $this->faker->randomElement(Developer::all()->pluck('id')->toArray());
//        $developer_names = Developer::all()->value('name');
//        $developer_names = $this->faker->randomElement(Developer::all()->pluck('name')->toArray());
        $startingDate = fake()->dateTimeThisYear('+1 month');
        $endingDate = strtotime('+1 Week', $startingDate->getTimestamp());
        return [
            'developer_id' => $developer_id,
            'names' => fake()->name,
            'start_date' => $startingDate,
            'end_date' => $endingDate,
            'user_hired_id' => fake()->numberBetween(1, 10)
        ];
    }
}
