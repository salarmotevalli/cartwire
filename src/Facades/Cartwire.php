<?php

namespace Cartwire\Facades;

class Cartwire extends \Illuminate\Support\Facades\Facade
{
    /**
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'cartwire';
    }
}
