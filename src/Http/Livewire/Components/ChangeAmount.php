<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class ChangeAmount extends Component {

    public $item_id;
    public $item_amount;

    public function changeAmount(int $item_amount, int $item_id)
    {
        // TODO: test
        if ($item_amount > 0) {
            Cart::updateAmount($item_id, $item_amount);
        } else {
            // TODO: send notif for deleting | test
        }

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