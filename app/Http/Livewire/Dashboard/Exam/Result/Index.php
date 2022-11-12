<?php

namespace App\Http\Livewire\Dashboard\Exam\Result;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.exam.result.index')->layoutData(['title' => 'Manage Exam Record | School Management System']);
    }
}
