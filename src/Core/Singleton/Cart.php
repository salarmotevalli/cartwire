<?php

namespace Cartwire\Core\Singleton;
use Exception;

class Cart {

    private static array $instances;


    protected function __construct() {}

    protected function __clone() {}

    public function __wakeup(): Exception
    {
        throw new Exception("Cannot unserialize a singleton.");
    }

    public static function getInstance(string $instance): static
    {
        if (! isset(self::$instances[$instance])) {
            self::$instances[$instance] = new static();
        }
        
        return self::$instances[$instance];
    }

    public function add()
    {
        
    }

}