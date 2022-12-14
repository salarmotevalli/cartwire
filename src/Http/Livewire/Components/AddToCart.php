<?php

namespace Cartwire\Http\Livewire\Components;

use Cartwire\Facades\Cartwire;

class AddToCart extends \Livewire\Component
{
    public array $data;

    /**
     * @return void
     */
    public function add()
    {
        Cartwire::add($this->data);
        $this->emit('item_added');

        if (config('cartwire.notification'))
            $this->dispatchBrowserEvent('cartwire-toast', ['message' => __('Item added')]);

    }

    public function render()
    {
        return view('cartwire::components.add-to-cart');
    }
}
