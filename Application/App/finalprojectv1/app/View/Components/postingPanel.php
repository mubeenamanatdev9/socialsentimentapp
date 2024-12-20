<?php

namespace App\View\Components;

use Illuminate\View\Component;

class postingPanel extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $name , $profileimage;
    public function __construct($name , $profileimage)
    {
         $this->name = $name;
         $this->profileimage = $profileimage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.posting-panel');
    }
}
