<?php

namespace Database\Seeders;


use App\Models\WeekDay ;
use Illuminate\Database\Seeder;

class WeekDaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weekdays = [
            'Monday',
            'Tuesday',
            'Wednesday',
            'Thursday',
            'Friday',
            'Saturday',
            'Sunday',
        ];

        foreach ($weekdays as $weekday) {
            WeekDay::firstOrCreate(['name' => $weekday]);
        }
    }
}
