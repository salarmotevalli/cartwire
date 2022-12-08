<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Livewire\Component;
use Salarmotevalli\CartWire\Contracts\Enums\TableColumnStatus;
use Salarmotevalli\CartWire\Facades\Cart;

class CartPage extends Component
{
    public array $items;

    public function mount()
    {
        $this->getCart();
    }

    protected function getListeners()
    {
        return [
            'cart_changed' => 'getCart'
        ];
    }
    
    public function getCart(): void
    {
        $this->items = Cart::get();
    }

    public function clearCart()
    {
        Cart::clear();
        $this->mount();
    }

    public function render()
    {
        $columns= config('cartwire.table-columns');
        $column_statuses = TableColumnStatus::options();

        return view('cartwire::cartpage', compact('columns', 'column_statuses'));
    }
}
