<?php

namespace App\View\Components\SideMenu;

use Illuminate\View\Component;

class CreateSubject extends Component
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
        $this->route='dashboard.subjects.index';
        
        $this->title='Subject';
        return view('components.side-menu.create-subject');
    }
}
