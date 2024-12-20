<?php

namespace App\View\Components;

use Illuminate\View\Component;

class postbody extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public $profileimage, $username, $createdat, $category, $subject, $postcontent, $totallikes, $totalshares;

    public function __construct(
        $username, $createdat, $category, $subject, $postcontent, $totallikes, $totalshares
    ) 
    {
        // $profileimage = $this->profileimage;
        // $username = $this->username;
        // $createdat = $this->createdat;
        // $category = $this->category;
        // $subject = $this->subject;
        // $postcontent = $this->postcontent;
        // $totallikes = $this->totallikes;
        // $totalshares = $this->totalshares;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.postbody');
    }
}
