<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subject>
 */
class SubjectFactory extends Factory
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
            'subject_code'=>$this->faker->numerify('###-###-####'),
            'school_id'=>1,
            'teacher_id'=>1,
            'class_id'=>1,
        ];
    }
}
