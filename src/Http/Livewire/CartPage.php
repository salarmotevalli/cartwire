<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class CartPage extends Component
{
    public function render()
    {
        return view('Cart::cartpage', [
                'items' => Cart::get()['models'],
                'coloumns' => config('cartwire.table')
            ]
        );
    }
}
