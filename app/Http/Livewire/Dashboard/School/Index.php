<?php

namespace App\Http\Livewire\Dashboard\School;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.school.index')->layoutData(['title' => ' Dashboard | School Management System']);
    }
}
