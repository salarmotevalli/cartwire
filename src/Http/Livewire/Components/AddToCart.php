<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Salarmotevalli\CartWire\Facades\Cart;

class AddToCart extends \Livewire\Component
{
    public int $userId;

    public function add()
    {
        Cart::add($this->userId);
//        $model = config('cartwire.model');
//        if(Cart::add($model::find($this->userId)))
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
//        Cart::clear();
//        dd(Cart::get());
    }

    public function render()
    {
//        Cart::clear();
        dd(Cart::get());
        return view('Cart::components.add-to-cart');
    }
}
