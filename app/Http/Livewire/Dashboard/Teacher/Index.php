<?php

namespace App\Http\Livewire\Dashboard\Teacher;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.teacher.index')->layoutData(['title' => ' Teacher | School Management System']);
    }
}
