<?php

namespace App\View\Components\SideMenu;

use Illuminate\View\Component;

class PromotionManage extends Component
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
        $this->route='dashboard.promote-students.promotion';
        
        $this->title='Promotion Manage';
        return view('components.side-menu.promotion-manage');
    }
}
