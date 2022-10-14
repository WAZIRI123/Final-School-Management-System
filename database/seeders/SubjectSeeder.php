<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $subject = Subject::firstOrCreate([
        'name'          => 'standard1',
        'school_id'         => 1,
        'class_id'         => 1,
        'subject_code'         => $faker->numerify('###-###-####'),
        'created_at'    => date("Y-m-d H:i:s")
        ]);
    }
}
