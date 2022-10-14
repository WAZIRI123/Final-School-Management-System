<?php

namespace App\View\Components\SideMenu;

use Illuminate\View\Component;

class SchoolSettings extends Component
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
        $this->route='dashboard.schools.settings-school';
        
        $this->title='School Settings';

        return view('components.side-menu.school-settings');
    }
}
