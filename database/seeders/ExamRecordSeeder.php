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

        ExamRecord::factory()->count(10)->create();
    }
}
