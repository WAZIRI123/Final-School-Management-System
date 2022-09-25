<?php

namespace App\Http\Livewire\Dashboard\Classes;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.classes.index')->layoutData(['title' => ' Class | School Management System']);
    }
}
