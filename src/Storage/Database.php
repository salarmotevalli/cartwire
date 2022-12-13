<?php

namespace Cartwire\Storage;

use Cartwire\Core\Strategy\StorageInterface;
use Cartwire\Exceptions\ParametersException;

class Database implements StorageInterface 
{
    public function __construct()
    {
        if ($this->get() == null) {
            $this->set($this->empty());
        }
    }

    public function get()
    {
        return request()->session()->get('cart');
    }

    public function add(array $item): void
    {
        // Check parameters
        if (! isset($item['id'], $item['price'])) {
            throw new ParametersException('Your entry data does\'n contain id and price, you must pass id and price.');
        }

        // Get current cart
        $cart = $this->get();

        $cart = $this->amountIncrement($cart, $item);

        $this->set($cart);
    }

    public function update(int $item, array $new_item)
    {
    }

    public function updateAmount(int $item_id, int $amount)
    {
        $cart = $this->get();
        $index = array_search($item_id, array_column($cart, 'id'));
        $cart[$index] = $this->setAmountAndTotal($cart[$index], $amount);
        $this->set($cart);
    }

    public function remove(int $item_id)
    {
        $cart = $this->get();
        array_splice($cart, array_search($item_id, array_column($cart, 'id')), 1);
        $this->set($cart);
    }

    public function count(): int
    {
        return count($this->get());
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    private function empty(): array
    {
        return [];
    }

    private function set($cart): void
    {
        request()->session()->put('cartwire', $cart);
    }

    private function amountIncrement(array $cart, array $item): array
    {
        // Check id exist
        $index = array_search($item['id'], array_column($cart, 'id'));

        if (is_int($index)) {
            $cart[$index] = $this->setAmountAndTotal($cart[$index], ++$cart[$index]['amount']);
        } else {
            $cart[] = $this->setAmountAndTotal($item, 1);
        }

        return $cart;
    }

    private function setAmountAndTotal(array $item, $amount): array
    {
        $item['amount'] = $amount;
        $item['total'] = $item['price'] * $item['amount'];

        return $item;
    }
}
