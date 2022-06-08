<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class CartPage extends Component
{
    public array $items;
    public array $columns;

    public function mount()
    {
        $this->items= Cart::get()['models'];
        $this->columns= config('cartwire.table');
    }

    public function render()
    {
        return view('Cart::cartpage');
    }
    protected $listeners = [
        'itemChanged' => 'updateCartTotal',
    ];

    public function updateCartTotal(): void
    {
        $this->mount();
        $this->render();
    }
}
