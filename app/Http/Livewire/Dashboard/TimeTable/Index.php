<?php

namespace App\Http\Livewire\Dashboard\TimeTable;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.time-table.index')->layoutData(['title' => ' Subject | School Management System']);
    }
}
