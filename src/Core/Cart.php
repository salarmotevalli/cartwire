<?php

namespace Cartwire\Core;

use Cartwire\Contracts\Cart as ContractsCart;

class Cart implements ContractsCart
{
    private static array $instances = [];

    private array $items = [];

    protected function __construct()
    {
    }

    protected function __clone()
    {
    }

    public function __wakeup()
    {
        throw new \Exception('Cannot unserialize a singleton.');
    }

    public static function getCart(string $cart = 'main'): static
    {
        if (! isset(self::$instances[$cart])) {
            self::$instances[$cart] = new static();
        }

        return self::$instances[$cart];
    }

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(): void
    {
    }
}
