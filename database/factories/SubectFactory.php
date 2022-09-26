<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subect>
 */
class SubectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'   => $this->faker->name,
            'subect_code'=>$this->faker->numerify('###-###-####'),
            'school_id'=>1,
            'class_id'=>1,
        ];
    }
}
