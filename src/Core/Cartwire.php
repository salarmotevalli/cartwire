<?php

namespace Cartwire\Core;

use Cartwire\Core\Strategy\StorageInterface;

class Cartwire
{
    private StorageInterface $driver;

    public function __construct()
    {
        $this->driver = new (config('cartwire.driver'));
    }

    /**
     * @return mixed
     */
    public function get(): mixed
    {
        return $this->driver()->get();
    }

    /**
     * @param  array  $item
     * @return void
     */
    public function add(array $item): void
    {
        $this->driver()->add($item);
    }

    /**
     * @param $item
     * @param  array  $new_item
     * @return mixed
     */
    public function update($item, array $new_item)
    {
        return $this->driver()->update($item, $new_item);
    }

    /**
     * @param  int  $item_id
     * @param  int  $amount
     * @return mixed
     */
    public function updateAmount(int $item_id, int $amount)
    {
        return $this->driver()->updateAmount($item_id, $amount);
    }

    /**
     * @param  int  $item_id
     * @return void
     */
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

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->driver()->clear();
    }
}
