<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class ChangeAmount extends Component {

    public $item_id;
    public $item_amount;

    public function changeAmount()
    {
        // TODO: validat amount, should be mor than zero
        Cart::updateAmount($this->item_id, $this->item_amount);
    }

    public function deleteItem(int $item_id): void
    {
        Cart::remove($item_id);
        $this->emit('item_deleted');
    }

    public function render()
    {
        return view('Cart::components.change-amount');
    }
}