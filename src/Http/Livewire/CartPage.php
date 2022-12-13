<?php

namespace Cartwire\Http\Livewire;

use Cartwire\Core\Enums\TableColumnStatus;
use Cartwire\Facades\Cartwire;
use Livewire\Component;

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

    /**
     * @return void
     */
    public function getCart(): void
    {
        $this->items = Cartwire::get();
    }

    /**
     * @return void
     */
    public function clearCart(): void
    {
        Cartwire::clear();
        $this->mount();
    }

    public function render()
    {
        $columns = config('cartwire.table-columns');
        $column_statuses = TableColumnStatus::options();

        return view('cartwire::cartpage', compact('columns', 'column_statuses'));
    }
}
