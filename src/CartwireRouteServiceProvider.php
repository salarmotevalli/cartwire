<?php

namespace Salarmotevalli\CartWire;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Route;

class CartwireRouteServiceProvider extends RouteServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        $this->routes(function () {
            Route::middleware('web')
                ->group(__DIR__.'/../routes/web.php');
        });
    }
}
