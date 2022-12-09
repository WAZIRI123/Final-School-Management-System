<?php

namespace Database\Seeders;

use App\Enums\ClassSectionEnum;
use App\Models\ExamRecord;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ExamRecordSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        ExamRecord::firstOrCreate([
            'id'          => 1,
            'class_id' => '1',
            'semester_id' => '1',
            'section_id' => ClassSectionEnum::A->value,
            'exam_id' => '1',
            'subject_id' => '1',
            'student_id' => '1',
            'academic_id'=>'1',
            'marks'=> $faker->numberBetween(10,100)
        ]);

        ExamRecord::firstOrCreate([
            'id'          => 2,
            'class_id' => '1',
            'semester_id' => '2',
            'section_id' => ClassSectionEnum::A->value,
            'exam_id' => '1',
            'subject_id' => '1',
            'student_id' => '1',
            'academic_id'=>'1',
            'marks'=>$faker->numberBetween(10,100)
        ]);
        ExamRecord::factory()->count(10)->create();
    }
}
