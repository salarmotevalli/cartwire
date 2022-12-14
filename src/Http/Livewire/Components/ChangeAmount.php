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
                $this->dispatchBrowserEvent('item_deleted', ['message' => 'fuck the world']);

        } else {
            // TODO: send notif for deleting | test
        }
    }

    /**
     * @return void
     */
    public function deleteItem(): void
    {
        Cartwire::remove($this->item_id);

        if (config('cartwire.notification'))
            $this->emit('item_deleted');
    }

    public function render()
    {
        return view('cartwire::components.change-amount');
    }
}
