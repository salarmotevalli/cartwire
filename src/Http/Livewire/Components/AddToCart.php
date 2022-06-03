<?php

namespace Salarmotevalli\CartWire\Http\Livewire\Components;

use Salarmotevalli\CartWire\Facades\Cart;

class AddToCart extends \Livewire\Component
{
    public int $item_id;

    public function add()
    {
        Cart::add($this->item_id);
        $this->emit('itemChanged');
//        $model = config('cartwire.model');
//        if(CartPage::add($model::find($this->userId)))
//        {
//            $this->emit('productAdded');
//            $this->dispatchBrowserEvent('notice', [
//                'type'=> 'success',
//                'title'=> 'اضافه شد',
//                'text'=> 'محصول با موفقیت به سبد خرید اضافه شد'
//            ]);
//            return;
//        };
//        $this->dispatchBrowserEvent('notice', [
//            'type'=> 'warning',
//            'title'=> 'موجودیت',
//            'text'=> 'این تعداد از محصول در انبار موجود نمی‌باشد'
//        ]);
//        CartPage::clear();
//        dd(CartPage::get());
    }

    public function render()
    {
        return view('Cart::components.add-to-cart');
    }
}
