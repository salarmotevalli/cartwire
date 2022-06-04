<?php
namespace Salarmotevalli\CartWire\Http\Livewire\Components;
use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class UpdateAmount extends Component
{
    public $amount;
    public $itemId;
    public function render()
    {
        return view('Cart::components.update-amount');
    }

    public function update()
    {
        Cart::updateAmount($this->itemId, $this->amount);
    }
}
