<?php
namespace Salarmotevalli\CartWire\Helper;


class Cart
{
    public function __construct()
    {
        if ($this->get() === null)
            $this->set($this->empty());
    }

    public function add(Attribute $attribute)
    {
        $cart = $this->get();
        $attribute->amount = !empty($attribute->amount) ? $attribute->amount : 1;

        foreach ($cart['products'] as $item) {
            if ($attribute->id == $item[0]['id']) {
                if ($item[0]['amount'] < $item[0]['quantity']) {
                    $cart['products'] = $this->attributeCartIncrement($attribute->id, $cart['products']);
                    $this->set($cart);
                    $status = true;
                    return $status;
                }
                $this->set($cart);
                $status = false;
                return $status;
            }
        }
        array_push($cart['products'], [$attribute->toArray(), $attribute->product->toArray()]);
        $this->set($cart);
        return true;
    }

    public function updateamount($attribute, $value)
    {
        $cart = $this->get();
        if ($attribute->quantity < $value) {
            session()->flash('error', "این تعداد از {$attribute->product->name} در انبار موجود نمیباشد");
            return  redirect(route('Cart'));
        }
        $cart['products'] = $this->attributeCartUpdate($attribute->id, $cart['products'], $value);
        $this->set($cart);
        return;
    }

    public function remove(int $attributeId): void
    {
        $cart = $this->get();
        array_splice($cart['products'], array_search($attributeId, array_column($cart['products'], 'id')), 1);
        $this->set($cart);
    }

    public function clear(): void
    {
        $this->set($this->empty());
    }

    public function empty(): array
    {
        return [
            'products' => [],
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

    private function attributeCartIncrement($attributeId, $cartItems)
    {
        $amount = 1;
        $cartItems = array_map(function ($item) use ($attributeId, $amount) {
            if ($attributeId == $item[0]['id']) {
                $item[0]['amount'] += $amount;
            }
            return $item;
        }, $cartItems);
        return $cartItems;
    }

    private function attributeCartUpdate($attributeId, $cartItems, $value)
    {
        $cartItems = array_map(function ($item) use ($attributeId, $value) {
            if ($attributeId == $item[0]['id']) {
                $item[0]['amount'] = $value;
            }
            return $item;
        }, $cartItems);
        return $cartItems;
    }

    public function orderPrice()
    {
        $price = 0;
        $r = $this->get();

        foreach ($r['products'] as $item) {
            if (isset($item[1]['offer'])) {
                $price +=  $item[1]['offer'] * $item[0]['amount'];
            } else {
                $price +=  $item[1]['price'] * $item[0]['amount'];
            }
        }
        return $price;
    }

    public function orderPriceWithPost()
    {
        return $this->orderPrice() + 18000;
    }
}

