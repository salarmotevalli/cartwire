<?php

namespace Cartwire\Core\Strategy;

interface StorageInterface
{
    public function get();

    public function add(array $item): void;

    public function update(int $item_id, array $new_item);

    public function updateAmount(int $item_id, int $amount);

    public function remove(int $item_id);

    public function count(): int;

    public function clear(): void;
}
