<?php

namespace Cartwire\Http\Livewire\Components;

use Cartwire\Facades\Cartwire;
use Livewire\Component;

class ChangeAmount extends Component
{
    public $item_id;

    public $item_amount;

    /**
     * @return void
     */
    public function updatedItemAmount()
    {
        // TODO: test
        if ($this->item_amount > 0) {
            Cartwire::updateAmount($this->item_id, $this->item_amount);
            $this->emit('item_changed');

            if (config('cartwire.notification'))
                $this->dispatchBrowserEvent('cartwire-toast', ['message' => __('Item amount changed', ['amount' => $this->item_amount])]);

        } else {
            // TODO: send notife for deleting | test
        }
    }

    /**
     * @return void
     */
    public function deleteItem(): void
    {
        Cartwire::remove($this->item_id);
        $this->emit('item_deleted');

        if (config('cartwire.notification'))
            $this->dispatchBrowserEvent('cartwire-toast', ['message' => __('Item deleted')]);
    }

    public function render()
    {
        return view('cartwire::components.change-amount');
    }
}
