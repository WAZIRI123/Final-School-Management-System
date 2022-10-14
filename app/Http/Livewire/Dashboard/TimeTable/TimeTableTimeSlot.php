<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use Livewire\Component;

class TimeTableTimeSlot extends Component
{
    public function render()
    {
        return view('livewire.dashboard.time-table.time-table-time-slot')->layoutData(['title' => ' TimeSlot | School Management System']);
    }
}
