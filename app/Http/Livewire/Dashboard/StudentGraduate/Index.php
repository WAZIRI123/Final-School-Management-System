<?php

namespace App\Http\Livewire\Dashboard\StudentGraduate;

use Livewire\Component;

class Index extends Component
{
    public $class;
    
    public $old_class;

    public $old_section;


    public function render()
    {
        return view('livewire.dashboard.student-graduate.index')->layoutData(['title' => ' Graduate | School Management System']);
    }
}
