<?php
namespace Salarmotevalli\CartWire\Http\Livewire\Components;
use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class NavigationItem extends Component
{
    protected $listeners = [
        'itemChanged' => 'updateCartTotal',
    ];

    public function updateCartTotal(): void
    {
        $this->count = count(Cart::get()['models']);
    }

    public int $count = 0;

    public function mount(): void
    {
        $this->count = count(Cart::get()['models']);
    }

    public function render()
    {
        return view('Cart::components.nav-link');
    }
}
