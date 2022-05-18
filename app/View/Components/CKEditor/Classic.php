<?php

namespace App\View\Components\CKEditor;

use Illuminate\View\Component;

class Classic extends Component
{
    /**
     * De textveld naam
     *
     * @var string
     */
    public $name;

    /**
     * Of het tekstveld required is
     *
     * @var string
     */
    public $required;

    /**
     * De tekst placeholder
     *
     * @var string
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $required = null, $placeholder = null)
    {
        $this->name = $name;
        $this->required = $required ? "required" : null;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ck-editor.classic');
    }
}
