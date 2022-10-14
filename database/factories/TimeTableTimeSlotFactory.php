<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TimeTableTimeSlot>
 */
class TimeTableTimeSlotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'timetable_id' => 1,
            'start_time'   => '14:02',
            'stop_time'    => '15:02',

        ];
    }
}
