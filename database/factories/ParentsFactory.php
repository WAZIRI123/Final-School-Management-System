<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Parents>
 */
class ParentsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $faker = \Faker\Factory::create();
        return [
            'user_id'           => 8,
            'admission_no'       => $faker->numerify('###-###-####'),
            'gender'            => 'male',
            'phone'             => '0123456789',
            'current_address'   => 'Dhaka-1215',
            'permanent_address' => 'Dhaka-1215',
            'created_at'        => date("Y-m-d H:i:s")
        ];
    }
}
