<?php

namespace Database\Seeders;

use App\Models\TimeTableTimeSlot;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TimeTableTimeSlotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TimeTableTimeSlot::firstOrCreate([
            'timetable_id' => 1,
            'start_time'   => '14:02',
            'stop_time'    => '15:02',
        ]);

    }
}
