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

    public function update($item, array $new_item)
    {
        return $this->driver()->update($item, $new_item);
    }

    public function updateAmount(int $item_id, int $amount)
    {
        return $this->driver()->updateAmount($item_id, $amount);
    }

    public function remove(int $item_id)
    {
        $this->driver->remove($item_id);
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
