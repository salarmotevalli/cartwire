<?php

namespace Salarmotevalli\CartWire\Http\Livewire;

use Salarmotevalli\CartWire\Facades\Cart;

class AddToCart extends \Livewire\Component
{

    public function addto($id)
    {
        $model= config('cartwire.model');
        dd($model);
        if(Cart::add($model::find($id)))
        {

//            $this->emit('productAdded');
//            $this->dispatchBrowserEvent('notice', [
//                'type'=> 'success',
//                'title'=> 'اضافه شد',
//                'text'=> 'محصول با موفقیت به سبد خرید اضافه شد'
//            ]);
//            return;
        };
//        $this->dispatchBrowserEvent('notice', [
//            'type'=> 'warning',
//            'title'=> 'موجودیت',
//            'text'=> 'این تعداد از محصول در انبار موجود نمی‌باشد'
//        ]);
        dd(Cart::get());
    }

    public function render()
    {
        return view('Cart::components.add-to-cart');
    }
}
