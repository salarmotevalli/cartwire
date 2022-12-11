<?php

namespace Cartwire\Core;

use Cartwire\Core\Strategy\StorageInterface;

class Cart
{
    private $driver;

    public function __construct() 
    {
        $this->driver = new (config('cartwire.driver'));
    }

    public function driver(StorageInterface $driver = null): StorageInterface
    {
        if ($driver != null) {
            $this->driver = $driver;
        }

        return $this->driver;
    }

}
