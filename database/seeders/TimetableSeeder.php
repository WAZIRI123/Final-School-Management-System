<?php

namespace Database\Seeders;

use App\Models\Timetable;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimetableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Timetable::firstOrCreate([
            'id'          => 1,
            'name'        => 'Timetable 1',
            'description' => 'Timetable 1 description',
            'class_id' => 1,
            'semester_id' => 1,
            'school_id' => 1,
        ]);
        Timetable::factory()->count(10)->create();
    }
}
