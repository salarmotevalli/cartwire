<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class CartPage extends Component
{
    public array $items;

    public array $columns;

    public function mount()
    {
        $this->getCart();
        $this->columns= config('cartwire.table');
    }

    public function render()
    {
        return view('Cart::cartpage');
    }
    
    public function getCart(): void
    {
        $this->items = Cart::get()['models'];
    }

    public function clearCart()
    {
        Cart::clear();
        $this->mount();
    }
}
