<?php

namespace Salarmotevalli\CartWire\Helper;

class Cart
{
    public mixed $models;

    public function __construct()
    {
        $model = config('cartwire.model');
        $this->models = $model;
        if ($this->get() === null)
            $this->set($this->empty());
    }

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    public function updateAmount(int $item_id, int $amount): void
    {
        $cart = $this->get();
        $index = array_search($item_id, array_column($cart['models'], 'id'));
        $cart['models'][$index]['amount'] = $amount;
        $this->set($cart);
    }

    public function add(int $model_id) //handle the adding item to cart
    {
        $model = $this->models::find($model_id);
        $cart = $this->get();
        $index = array_search($model_id, array_column($cart['models'], 'id'));

        if (is_int($index)) {
            $this->amountIncrement($cart, $index);
            return;
        }

        $this->addFirstToCart($cart, $model);
    }

    public function count(): int {
        return count($this->get()['models']);
    }

    public function remove(int $item_id): void
    {
        $cart = $this->get();
        array_splice($cart['models'], array_search($item_id, array_column($cart['models'], 'id')), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    private function empty(): array
    {
        return [
            'models' => [],
        ];
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }

    private function amountIncrement(array $cart, int $index)
    {
        $cart['models'][$index]['amount']++;
        $this->set($cart);
    }

    private function addFirstToCart($cart, $model)
    {
        $model->amount = 1;
        $cart['models'][] = $model->toArray();
        $this->set($cart);
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

    // public function orderPriceWithPost()
    // {
    //     return $this->orderPrice() + 18000;
    // }

}
