<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class ChangeAmount extends Component {

    public $item_id;
    public $item_amount;

    public function updatedItemAmount()
    {
        // TODO: test
        if ($this->item_amount > 0) {
            Cart::updateAmount($this->item_id, $this->item_amount);
        } else {
            // TODO: send notif for deleting | test
        }

    }

    public function deleteItem(): void
    {
        Cart::remove($this->item_id);
        $this->emit('item_deleted');
    }

    public function render()
    {
        return view('Cart::components.change-amount');
    }
}