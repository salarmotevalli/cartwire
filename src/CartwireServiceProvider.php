<?php

namespace Cartwire;

use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Cartwire\Console\InstallCommand;
use Cartwire\Core\Cartwire;
use Cartwire\Http\Livewire\CartPage;
use Cartwire\Http\Livewire\Components\AddToCart;
use Cartwire\Http\Livewire\Components\ChangeAmount;
use Cartwire\Http\Livewire\Components\NavigationItem;

class CartwireServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/cartwire.php', 'cartwire');

        App::bind('cartwire', function () {
            return new Cartwire();
        });

        $this->registerCommands();
    }

    public function boot()
    {
        //load views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'cartwire');

        // register livewire components
        $this->registerLivewireComponents();

        // incloud all publishes
        $this->registerPublishes();
    }

    private function registerCommands()
    {
        $commands = [
            InstallCommand::class,
        ];

        $this->commands($commands);
    }

    public function registerLivewireComponents()
    {
        Livewire::component('CartPage', CartPage::class);
        Livewire::component('NavigationItem', NavigationItem::class);
        Livewire::component('AddToCart', AddToCart::class);
        Livewire::component('change-amount', ChangeAmount::class);
    }

    public function registerPublishes()
    {
        // langs
        $this->publishes([
            __DIR__ . '/../lang' => lang_path('vendor/cartwire'),
        ]);

        // views
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/cartwire'),
        ], 'cartwire-views');

        // config
        $this->publishes([
            __DIR__ . '/../config/cartwire.php' => config_path('cartwire.php'),
        ], 'cartwire-config');
    }
}
