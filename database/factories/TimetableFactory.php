<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timetable>
 */
class TimetableFactory extends Factory
{
    /**
     * Define the model's default state 0656182172.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id'          => $this->faker->numberBetween(1, 10000),
            'name'        => $this->faker->name,
            'description' => $this->faker->name,
            'class_id' =>$this->faker->numberBetween(2, 5),
            'semester_id' => $this->faker->numberBetween(2, 5),
            'school_id' => $this->faker->numberBetween(2, 5),
        ];
    }
}
