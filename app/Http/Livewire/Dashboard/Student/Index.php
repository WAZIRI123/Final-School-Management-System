<?php

namespace App\Http\Livewire\Dashboard\Student;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.student.index')->layoutData(['title' => ' Dashboard | School Management System']);
    }
}
