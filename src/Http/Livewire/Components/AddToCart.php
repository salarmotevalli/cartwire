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
        $this->emit('itemChanged');
    }

    public function render()
    {
        return view('cartwire::components.add-to-cart');
    }
}
