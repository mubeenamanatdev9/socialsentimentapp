<?php

namespace App\View\Components;

use Illuminate\View\Component;

class headbody extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $title, $backgroundimage;
    public function __construct(
        $title,$backgroundimage
    )
    {
       $this->title = $title;
       $this->backgroundimage = $backgroundimage;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.headbody');
    }
}
