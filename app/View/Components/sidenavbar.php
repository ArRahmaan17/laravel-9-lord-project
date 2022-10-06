<?php

namespace App\View\Components;

use Illuminate\View\Component;

class sidenavbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $navbar = [
            ['name' => 'Home', 'url' => '/', 'icon' => 'fas fa-fire'],
            ['name' => 'Profile', 'url' => '/profile', 'icon' => 'far fa-user'],
            ['name' => 'About', 'url' => '/about', 'icon' => 'fas fa-ellipsis-h'],
            ['name' => 'Contact', 'url' => '/', 'icon' => 'fas fa-envelope'],
        ];
        return view('components.navbar', ['appTitle' => "Rarewel Lord", 'navbar' => $navbar]);
    }
}
