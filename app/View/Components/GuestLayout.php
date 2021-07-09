<?php

namespace App\View\Components;

use App\Services\MockiService;
use Illuminate\View\Component;

class GuestLayout extends Component
{
    public $test;
    public $names;

    public function __construct(MockiService $service)
    {
        $this->names = $service->resolveUsersNames();

        $this->test = 'hola2';
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.guest');
    }
}
