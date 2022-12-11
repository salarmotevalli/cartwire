<?php

namespace Cartwire\Core\Strategy;

use Cartwire\Contracts\Cart;
use Cartwire\Contracts\Item;

interface StorageInterface {

    public function get(): Cart;

    public function add(): void;

    public function update(Item $item, array $new_item): Cart;

    public function updateAmount(Item $item, int $amount): Cart;

    public function remove(Item $item): Cart;

    public function count(): int;

    public function clear(): void;


}