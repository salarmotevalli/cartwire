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

    public function add(int $modelId): bool //handle the adding item to cart
    {
        $model = $this->models::find($modelId);
        $cart = $this->get();
        $index = array_search($modelId, array_column($cart['models'], 'id'));
        if (is_int($index)) {
            return $this->amountIncrement($cart, $index);
        }
        return $this->addFirstToCart($cart, $model);
    }

    public function updateAmount($item_id, $amount)
    {
        $cart = $this->get();
        $index = array_search($item_id, array_column($cart['models'], 'id'));
        $cart['models'][$index]['amount'] = $amount;
        $this->set($cart);
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

    public function get(): ?array
    {
        return request()->session()->get('cart');
    }

    private function set($cart): void
    {
        request()->session()->put('cart', $cart);
    }

    private function amountIncrement($cart, $index): bool
    {
        $cart['models'][$index]['amount']++;
        $this->set($cart);
        return true;
    }

    private function addFirstToCart($cart, $model): bool
    {
        $model->amount = 1;
        $cart['models'][] = $model->toArray();
        $this->set($cart);
        return true;
    }

    public function orderPrice(): int
    {
        $price = 0;
        $r = $this->get();

        foreach ($r['models'] as $item) {
            if (isset($item[1]['offer'])) {
                $price += $item[1]['offer'] * $item[0]['amount'];
            } else {
                $price += $item[1]['price'] * $item[0]['amount'];
            }
        }
        return $price;
    }

    public function orderPriceWithPost()
    {
        return $this->orderPrice() + 18000;
    }
}
