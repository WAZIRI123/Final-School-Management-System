<?php

namespace App\View\Components\SideMenu;

use Illuminate\View\Component;

class StudentGraduate extends Component
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
        $this->route='dashboard.graduate-students.index';
        
        $this->title='Student Graduate';
        return view('components.side-menu.student-graduate');
    }
}
