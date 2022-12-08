<?php

namespace Salarmotevalli\CartWire\Helper;

use Salarmotevalli\CartWire\Exceptions\ParametersException;

class Cart
{
    public function __construct()
    {
        if ($this->get() === null)
            $this->set($this->empty());
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    public function updateAmount(mixed $item_id, int $amount): void
    {
        $cart = $this->get();
        $index = array_search($item_id, array_column($cart, 'id'));
        $cart[$index] = $this->setAmountAndPrice([], $amount); 
        $this->set($cart);
    }

    public function add(array $data): void
    {
        // Check parameters
        if (!isset($data['id'], $data['price']))
            throw new ParametersException('Your entry data does\'n contain id and price, you must pass id and price.');

        // Get current cart
        $cart = $this->get();

        // Check id exist
        $index = array_search($data['id'], array_column($cart, 'id'));

        // TODO: handle just in one method
        $cart = is_int($index) 
            ? $this->amountIncrement($cart, $index)
            : $this->addFirstToCart($cart, $data);

        $this->set($cart);
    }

    public function count(): int
    {
        return count($this->get());
    }

    public function remove(int $item_id): void
    {
        $cart = $this->get();
        array_splice($cart, array_search($item_id, array_column($cart, 'id')), 1);
        $this->set($cart);
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
        request()->session()->put('cart', $cart);
    }

    private function amountIncrement(array $cart, int $index): array
    {
        $cart[$index] = $this->setAmountAndPrice([], $cart[$index]['amount']++); 
        return $cart;
    }

    private function addFirstToCart(array $cart,array $item): array
    {
        $item['amount'] = 1;
        $item['total'] = $item['price'];
        $cart[] = $item;
        return $cart;
    }

    private function setAmountAndPrice(array $item, $amount): array
    {
        $item['amount'] = $amount;
        $item['total'] = $item['price'] * $item['amount'];
        return $item;
    }

    // public function orderPrice(): int
    // {
    //     $price = 0;
    //     $r = $this->get();

    //     foreach ($r['models'] as $item) {
    //         if (isset($item[1]['offer'])) {
    //             $price += $item[1]['offer'] * $item[0]['amount'];
    //         } else {
    //             $price += $item[1]['price'] * $item[0]['amount'];
    //         }
    //     }
    //     return $price;
    // }
}
