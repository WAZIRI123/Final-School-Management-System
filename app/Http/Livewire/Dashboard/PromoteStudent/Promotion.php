<?php

namespace App\Http\Livewire\Dashboard\PromoteStudent;

use Livewire\Component;

class Promotion extends Component
{
    public function render()
    {
        return view('livewire.dashboard.promote-student.promotion')->layoutData(['title' => ' promotions | School Management System']);
    }
}
