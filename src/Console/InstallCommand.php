<?php

namespace Salarmotevalli\CartWire\Console;

use Illuminate\Console\Command;

class InstallCommand extends Command
{
     /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cartwire:install {ui}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Cartwire components and resources';

    public function handle()
    {

        if (!in_array($this->argument('ui'), ['bootstrap', 'tailwind'])) {
            $this->components->error('Invalid stack. Supported option are [bootstrap], [tailwind] and [pure].');

            return 1;
        }

        if ($this->argument('ui') === 'bootstrap') {
            $this->installbootstrapUi();
        } elseif ($this->argument('ui') === 'tailwind') {
            // $this->installInertiaStack();
        }

        $this->publishes();

    }




    private function installbootstrapUi()
    {
        $viewPath = '/../../resources/views';
        $bootstrapStubsPath = '/../../stubs/views/bootstrap';

        $array = [
            __DIR__ . $bootstrapStubsPath . '/cartpage.blade.php' => __DIR__ . $viewPath . '/cartpage.blade.php',
            __DIR__ . $bootstrapStubsPath . '/components/add-to-cart.blade.php' => __DIR__ . $viewPath . '/components/add-to-cart.blade.php',
            __DIR__ . $bootstrapStubsPath . '/components/change-amount.blade.php' => __DIR__ . $viewPath . '/components/change-amount.blade.php',
            __DIR__ . $bootstrapStubsPath . '/components/nav-link.blade.php' => __DIR__ . $viewPath . '/components/nav-linke.blade.php',
        ];

        foreach ($array as $from => $to) {
            copy($from, $to);
        }
    }

    private function publishes() {
        $this->callSilent('vendor:publish', ['--tag' => 'cartwire-config', '--force' => true]);
        $this->callSilent('vendor:publish', ['--tag' => 'cartwire-views', '--force' => true]);
    }
}