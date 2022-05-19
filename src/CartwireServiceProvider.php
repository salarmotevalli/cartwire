<?php
namespace Salarmotevalli\CartWire;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Salarmotevalli\CartWire\Helper\Cart;
use Salarmotevalli\CartWire\Http\Livewire\AddToCart;
use Salarmotevalli\CartWire\Http\Livewire\NavigationItem;

class CartwireServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/cartwire.php', 'cartwire');
        App::bind('cart',function() {
            return new Cart();
        });
    }


    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'Cart');
        Livewire::component('NavigationItem', NavigationItem::class);
        Livewire::component('AddToCart', AddToCart::class);
    }


    protected function configureComponents()
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('add-to-cart');

        });
    }

    protected function registerComponent(string $component)
    {
        Blade::component('Cart::components.'.$component, 'cart-'.$component);
    }


}
