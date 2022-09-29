<?php

namespace App\Http\Livewire\Dashboard\AcademicYear;

use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.dashboard.academic-year.index')->layoutData(['title' => ' Academic-Year | School Management System']);
    }
}
