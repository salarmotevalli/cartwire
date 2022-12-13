<?php

namespace Cartwire\Core\Strategy;

interface StorageInterface
{
    /**
     * @return mixed
     */
    public function get();

    /**
     * @param  array  $item
     * @return void
     */
    public function add(array $item): void;

    /**
     * @param  int  $item_id
     * @param  array  $new_item
     * @return mixed
     */
    public function update(int $item_id, array $new_item);

    /**
     * @param  int  $item_id
     * @param  int  $amount
     * @return mixed
     */
    public function updateAmount(int $item_id, int $amount);

    /**
     * @param  int  $item_id
     * @return mixed
     */
    public function remove(int $item_id);

    /**
     * @return int
     */
    public function count(): int;

    /**
     * @return void
     */
    public function clear(): void;
}
