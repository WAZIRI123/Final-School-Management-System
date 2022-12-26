<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\timetableRecord>
 */
class timetableRecordFactory extends Factory
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
            'user_id'           => 1,
            'parent_id'         => 1,
            'class_id'          => 1,
            'section'          => 'A',
            'admission_no'       => $faker->numerify('###-###-####'),
            'gender'            => 'male',
            'phone'             => '0123456789',
            'dateofbirth'       => '1993-04-11',
            'current_address'   => 'Dhaka-1215',
            'permanent_address' => 'Dhaka-1215',
            'created_at'        => date("Y-m-d H:i:s")
        ];
    }
}
