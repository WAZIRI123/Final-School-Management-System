<?php

namespace App\Http\Livewire\Dashboard\Subject;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.subject.index')->layoutData(['title' => ' Subject | School Management System']);
    }
}
