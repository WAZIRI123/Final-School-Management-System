<?php

namespace App\Http\Livewire\Dashboard\Semester;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.semester.index')->layoutData(['title' => ' Semester | School Management System']);
    }
}
