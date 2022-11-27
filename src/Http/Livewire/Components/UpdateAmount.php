<?php
namespace Salarmotevalli\CartWire\Http\Livewire\Components;
use Livewire\Component;
use Salarmotevalli\CartWire\Facades\Cart;

class UpdateAmount extends Component
{
    public $item_amount;
    public $item_id;
   
    public function update()
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
        return view('Cart::components.update-amount');
    }
}
