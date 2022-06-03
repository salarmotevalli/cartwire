<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class CartPage extends Component
{
    public function render()
    {

        return view('Cart::cartpage', [
                'items' => Cart::get()['models'],
                'columns' => config('cartwire.table')
            ]
        );
    }
}
