<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classes>
 */
class ClassesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'class_name'    => $this->faker->name(),
            'class_code' => $this->faker->name(),
            'school_id'=>1,
            'created_at'    => date("Y-m-d H:i:s")
        ];
    }
}
