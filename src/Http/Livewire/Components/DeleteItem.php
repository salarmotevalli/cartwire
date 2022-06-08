<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;
use Salarmotevalli\CartWire\Facades\Cart;

class DeleteItem extends \Livewire\Component
{
    public int $itemId;
    public bool $show= true;

    public function render()
    {
        return view('Cart::components.delete-item');
    }

    public function deleteItem():void
    {
        Cart::remove($this->itemId);
        $this->emitUp('itemChanged');
        $this->show= false;
    }


}
