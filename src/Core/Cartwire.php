<?php

namespace Cartwire\Core;

use Cartwire\Contracts\Cart as ContInterface;
use Cartwire\Core\Strategy\StorageInterface;

class Cartwire
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

    /**
     * @return ContInterface
     */
    public function get(): ContInterface
    {
        return $this->driver()->get();
    }

    public function add(array $item): void
    {
        $this->driver()->add($item);
    }

    /**
     * @param  \Cartwire\Contracts\Item  $item
     * @param  array  $new_item
     * @returnContInterface
     */
    public function update(\Cartwire\Contracts\Item $item, array $new_item): ContInterface
    {
        return $this->driver()->update($item, $new_item);
    }

    /**
     * @param  \Cartwire\Contracts\Item  $item
     * @param  int  $amount
     * @return ContInterface
     */
    public function updateAmount(\Cartwire\Contracts\Item $item, int $amount): ContInterface
    {
        return $this->driver()->updateAmount($item, $amount);
    }

    /**
     * @param  \Cartwire\Contracts\Item  $item
     */
    public function remove(\Cartwire\Contracts\Item $item)
    {
        $this->driver->remove($item);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return $this->driver()->count();
    }

    public function clear(): void
    {
        $this->driver()->clear();
    }
}
