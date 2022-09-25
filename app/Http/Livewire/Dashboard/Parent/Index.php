<?php

namespace App\Http\Livewire\Dashboard\Parent;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.parent.index')->layoutData(['title' => ' Parent | School Management System']);
    }
}
