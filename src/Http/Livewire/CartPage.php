<?php

namespace Cartwire\Http\Livewire;

use Livewire\Component;
use Cartwire\Core\Enums\TableColumnStatus;
use Cartwire\Facades\Cart;

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
            'cart_changed' => 'getCart',
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
        $columns = config('cartwire.table-columns');
        $column_statuses = TableColumnStatus::options();

        return view('cartwire::cartpage', compact('columns', 'column_statuses'));
    }
}
