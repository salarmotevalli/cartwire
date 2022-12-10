<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class NavigationItem extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->count = count(Cart::get());
    }

    protected $listeners = [
        'itemChanged' => 'updateCartTotal',
    ];

    public function updateCartTotal(): void
    {
        $this->count = Cart::count();
    }

    public function render()
    {
        return view('cartwire::components.nav-link');
    }
}
