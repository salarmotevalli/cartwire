<?php

namespace Salarmotevalli\CartWire\Helper;

class Cart
{
    public mixed $models;

    public function __construct()
    {
        $model = config('cartwire.model');
        $this->models = new $model;
        if ($this->get() === null)
            $this->set($this->empty());
    }

    public function add(int $modelId): bool //handle the adding item to cart
    {
        $model = $this->models->find($modelId);
        $cart = $this->get();
        $index = array_search($modelId, array_column($cart['models'], 'id'));
        if (is_int($index)) {
            return $this->amountIncrement($cart, $index);
        }
        return $this->addFirstToCart($cart, $model);
    }

    public function updateamount($attribute, $value)
    {
        $cart = $this->get();
        if ($attribute->quantity < $value) {
            session()->flash('error', "این تعداد از {$attribute->product->name} در انبار موجود نمیباشد");
            return redirect(route('CartPage'));
        }
        $cart['models'] = $this->attributeCartUpdate($attribute->id, $cart['models'], $value);
        $this->set($cart);
        return;
    }

    public function remove(int $itemId): void
    {
        $cart = $this->get();
        array_splice($cart['models'], array_search($itemId, array_column($cart['models'], 'id')), 1);
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

    private function attributeCartUpdate($attributeId, $cartItems, $value): array
    {
        $cartItems = array_map(function ($item) use ($attributeId, $value) {
            if ($attributeId == $item[0]['id']) {
                $item[0]['amount'] = $value;
            }
            return $item;
        }, $cartItems);
        return $cartItems;
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
