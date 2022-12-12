<?php

namespace Cartwire\Core;

use Cartwire\Core\Strategy\StorageInterface;

class Cartwire
{
    private $driver;

    public function __construct()
    {
        $this->driver = new (config('cartwire.driver'));
    }

    public function driver(StorageInterface $driver = null)
    {
        if ($driver != null) {
            $this->driver = $driver;
        }

        return $this->driver;
    }

    public function get()
    {
        return $this->driver()->get();
    }

    public function add(array $item): void
    {
        $this->driver()->add($item);
    }

    public function update(\Cartwire\Contracts\Item $item, array $new_item)
    {
        return $this->driver()->update($item, $new_item);
    }

    public function updateAmount(\Cartwire\Contracts\Item $item, int $amount)
    {
        return $this->driver()->updateAmount($item, $amount);
    }

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
