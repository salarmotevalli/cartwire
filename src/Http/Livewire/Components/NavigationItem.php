<?php

namespace Cartwire\Http\Livewire\Components;

use Cartwire\Facades\Cartwire;
use Livewire\Component;

class NavigationItem extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->count = count(Cartwire::get());
    }

    protected $listeners = [
        'itemChanged' => 'updateCartTotal',
    ];

    public function updateCartTotal(): void
    {
        $this->count = Cartwire::count();
    }

    public function render()
    {
        return view('cartwire::components.nav-link');
    }
}
