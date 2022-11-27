<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Salarmotevalli\CartWire\Facades\Cart;
use Salarmotevalli\CartWire\Http\Livewire\CartPage;

class AddToCart extends \Livewire\Component
{
    public int $item_id;

    public function add()
    {
        Cart::add($this->item_id);
        $this->emit('itemChanged');
    }

    public function render()
    {
        return view('Cart::components.add-to-cart');
    }
}
