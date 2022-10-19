<?php

namespace App\Http\Livewire\Dashboard\Exam;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.exam.index')->layoutData(['title' => ' Exam | School Management System']);
    }
}
