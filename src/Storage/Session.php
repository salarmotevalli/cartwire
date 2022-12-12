<?php

namespace Cartwire\Storage;

use Cartwire\Contracts\Cart as CartInterface;
use Cartwire\Contracts\Item as ItemInterface;
use Cartwire\Core\Cart;
use Cartwire\Core\Item;
use Cartwire\Core\Strategy\StorageInterface;
use Cartwire\Exceptions\ParametersException;

class Session implements StorageInterface
{
    // public function __construct()
    // {
    //     if ($this->get() === null) {
    //         $this->set($this->empty());
    //     }
    // }

    // public function get(): ?array
    // {
    //     return request()->session()->get('cart');
    // }

    // public function updateAmount(mixed $item_id, int $amount): void
    // {
    //     $cart = $this->get();
    //     $index = array_search($item_id, array_column($cart, 'id'));
    //     $cart[$index] = $this->setAmountAndTotal($cart[$index], $amount);
    //     $this->set($cart);
    // }

    // public function add(array $item): void
    // {
    //     // Check parameters
    //     if (!isset($item['id'], $item['price'])) {
    //         throw new ParametersException('Your entry data does\'n contain id and price, you must pass id and price.');
    //     }

    //     // Get current cart
    //     $cart = $this->get();

    //     // TODO: handle just in one method
    //     $cart = $this->amountIncrement($cart, $item);

    //     $this->set($cart);
    // }

    // public function count(): int
    // {
    //     return count($this->get());
    // }

    // public function remove(int $item_id): void
    // {
    //     $cart = $this->get();
    //     array_splice($cart, array_search($item_id, array_column($cart, 'id')), 1);
    //     $this->set($cart);
    // }

    // public function clear(): void
    // {
    //     $this->set($this->empty());
    // }

    /**
     * @return CartInterface
     */
    public function get(): CartInterface
    {
        return Cart::getCart();
    }

    public function add(array $item): void
    {
        // if (!isset($item['id'], $item['price'])) {
        //     throw new ParametersException('Your entry data does\'n contain id and price, you must pass id and price.');
        // }

        // $item = new Item($item);

        // // Get current cart
        // $cart = $this->get();

        // $cart = $this->amountIncrement($cart, $item);

        // $this->set($cart);
    }

    /**
     * @param  Item  $item
     * @param  array  $new_item
     * @return CartInterface
     */
    public function update(ItemInterface $item, array $new_item): CartInterface
    {
    }

    /**
     * @param  ItemInterface  $item
     * @param  int  $amount
     * @return CartInterface
     */
    public function updateAmount(Item $item, int $amount): CartInterface
    {
    }

    /**
     * @param  ItemInterface  $item
     */
    public function remove(ItemInterface $item)
    {
    }

    /**
     * @return int
     */
    public function count(): int
    {
    }

    public function clear(): void
    {
    }

    private function empty(): array
    {
        return [];
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
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
