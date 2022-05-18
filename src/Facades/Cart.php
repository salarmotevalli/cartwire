<?php
namespace Salarmotevalli\CartWire\Facades;

class Cart extends \Illuminate\Support\Facades\Facade
{
    public static function getFacadeAccessor()
    {
        return 'cart';
    }
}
