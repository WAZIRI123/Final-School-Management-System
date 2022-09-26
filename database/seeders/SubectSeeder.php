<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        Subject::create([
            'name'          => 'Hisabati',
            'school_id'         => 1,
            'subject_code'         => $faker->numerify('###-###-####'),
            'class_id'      => 1,
            'created_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
