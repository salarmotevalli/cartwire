<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Salarmotevalli\CartWire\Facades\Cart;

class AddToCart extends \Livewire\Component
{
    public array $data;

    public function add()
    {
        Cart::add($this->data);
        $this->emit('itemChanged');
    }

    public function render()
    {
        return view('cartwire::components.add-to-cart');
    }
}
