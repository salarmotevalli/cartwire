<?php
namespace Salarmotevalli\CartWire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Salarmotevalli\CartWire\Helper\Cart;
use Salarmotevalli\CartWire\Http\Livewire\NavigationItem;

class CartWireServiceProvider extends ServiceProvider
{
    public function register()
    {
        App::bind('cart',function() {
            return new Cart();
        });
        $this->mergeConfigFrom(__DIR__.'/../config/cartwire.php', 'cartwire');
    }


    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'Cart');
        Livewire::component('NavigationItem', NavigationItem::class);
    }
}
