<?php

namespace Cartwire\Core\Strategy;

interface StorageInterface
{
    public function get();

    public function add(array $item): void;

    public function update($item, array $new_item);

    public function updateAmount($item, int $amount);

    public function remove($item);

    public function count(): int;

    public function clear(): void;
}
