<?php

namespace Salarmotevalli\CartWire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Salarmotevalli\CartWire\Console\InstallCommand;
use Salarmotevalli\CartWire\Helper\Cart;
use Salarmotevalli\CartWire\Http\Livewire\CartPage;
use Salarmotevalli\CartWire\Http\Livewire\Components\AddToCart;
use Salarmotevalli\CartWire\Http\Livewire\Components\ChangeAmount;
use Salarmotevalli\CartWire\Http\Livewire\Components\NavigationItem;
use Salarmotevalli\CartWire\Http\Livewire\Components\UpdateAmount;

class CartwireServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cartwire.php', 'cartwire');
        App::bind('cart', function () {
            return new Cart();
        });

        $this->registerCommands();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'Cart');
        Livewire::component('CartPage', CartPage::class);
        Livewire::component('NavigationItem', NavigationItem::class);
        Livewire::component('AddToCart', AddToCart::class);
        Livewire::component('UpdateAmount', UpdateAmount::class);
        Livewire::component('change-amount', ChangeAmount::class);
    }

    private function registerCommands() {
        $commands = [
            InstallCommand::class,
        ];

        $this->commands($commands);
    }
}
