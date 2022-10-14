<?php

namespace App\View\Components\SideMenu;

use Illuminate\View\Component;

class CreateTimeSlot extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $route;
    public $title;

    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $this->route='dashboard.time-tables.timetableslot';
        
        $this->title='Create TimeSlot';
        return view('components.side-menu.create-time-slot');
    }
}
