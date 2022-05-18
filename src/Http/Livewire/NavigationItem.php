<?php
namespace Salarmotevalli\CartWire\Http\Livewire;
use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class NavigationItem extends Component
{
    public int $count = 0;

    public function mount(): void
    {
        $this->count = count(Cart::get()['products']);
    }

    public function render()
    {
        return view('Cart::components.nav-link');
    }
}
