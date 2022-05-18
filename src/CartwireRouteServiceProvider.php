<?php

namespace Salarmotevalli\CartWire;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;

class CartwireRouteServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}
