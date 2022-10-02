<?php

namespace App\Http\Livewire\Dashboard\PromoteStudent;

use App\Models\Classes;
use Livewire\Component;

class Index extends Component
{
    public $class;
    
    public $old_class;

    public $old_section;

    public $new_class;

    public $new_section;




    public function render()
    {
        return view('livewire.dashboard.promote-student.index')->layoutData(['title' => ' Promote | School Management System']);
    }
}
