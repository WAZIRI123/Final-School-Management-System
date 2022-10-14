<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use App\Models\Subject;
use App\Models\WeekDay;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class SyncTimeSlotWithWeekDay extends Component
{
    use WithPagination,AuthorizesRequests;

    public $selected_weekday;

    public $selected_subject;

    public $weekdays;
    public $subject;

    public function mount()
    {
        $this->weekdays = WeekDay::all();
        $this->subject = Subject::all();
    }



    public function render()
    {
        return view('livewire.dashboard.time-table.sync-time-slot-with-week-day');
    }
}
