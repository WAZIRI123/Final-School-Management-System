<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;

class TallCrud extends Component
{
    public function render()
    {
        return view('livewire.dashboard.tall-crud')->layoutData(['title' => ' Dashboard | School Management System']);
    }
}
