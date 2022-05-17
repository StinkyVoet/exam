<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Header extends Component
{
    /**
     * De header hoogte
     *
     * @var string
     */
    public $height;

    /**
     * De header titel
     *
     * @var string
     */
    public $title;

    /**
     * De header ondertitel
     *
     * @var [type]
     */
    public $undertitle;

    /**
     * De header image
     *
     * @var string
     */
    public $img;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($height = null, $title = null, $img = null, $undertitle = null)
    {
        $this->height = $height;
        $this->title = $title;
        $this->img = $img;
        $this->undertitle = $undertitle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.header');
    }
}
