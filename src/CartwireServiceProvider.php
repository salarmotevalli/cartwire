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

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cartwire');

        Livewire::component('CartPage',         CartPage::class);
        Livewire::component('NavigationItem',   NavigationItem::class);
        Livewire::component('AddToCart',        AddToCart::class);
        Livewire::component('change-amount',    ChangeAmount::class);

        $this->publishes([
            __DIR__ . '/../lang' => lang_path('vendor/cartwire'),
        ]);

        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/cartwire'),
        ], 'cartwire-views');

        $this->publishes([
            __DIR__ . '/../config/cartwire.php' => config_path('cartwire.php'),
        ], 'cartwire-config');
    }

    private function registerCommands()
    {
        $commands = [
            InstallCommand::class,
        ];

        $this->commands($commands);
    }
}
