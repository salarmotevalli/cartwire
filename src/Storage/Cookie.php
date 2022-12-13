<?php

namespace Cartwire\Storage;

use Cartwire\Core\Strategy\StorageInterface;
use Cartwire\Exceptions\ParametersException;
use Illuminate\Support\Facades\Cookie as CookieFacade;

class Cookie implements StorageInterface
{
    private readonly string $storeKey;

    public function __construct()
    {
        $this->storeKey = config('cartwire.store-key');

        if ($this->get() == null) {
            $this->set($this->empty());
        }
    }

    /**
     * @return mixed
     */
    public function get(): mixed
    {
        $cookie = CookieFacade::get($this->storeKey);

        // Check coockie is stil there
        return is_array(unserialize($cookie))
            ? unserialize($cookie)
            : [];
    }

    /**
     * @param  array  $item
     * @return void
     *
     * @throws ParametersException
     */
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

    /**
     * @param  int  $item_id
     * @param  int  $amount
     * @return void
     */
    public function updateAmount(int $item_id, int $amount)
    {
        $cart = $this->get();
        $index = array_search($item_id, array_column($cart, 'id'));
        $cart[$index] = $this->setAmountAndTotal($cart[$index], $amount);
        $this->set($cart);
    }

    /**
     * @param  int  $item_id
     * @return void
     */
    public function remove(int $item_id)
    {
        $cart = $this->get();
        array_splice($cart, array_search($item_id, array_column($cart, 'id')), 1);
        $this->set($cart);
    }

    /**
     * @return int
     */
    public function count(): int
    {
        return count($this->get());
    }

    /**
     * @return void
     */
    public function clear(): void
    {
        $this->set($this->empty());
    }

    /**
     * @return array
     */
    private function empty(): array
    {
        return [];
    }

    /**
     * @param $cart
     * @return void
     */
    private function set($cart): void
    {
        CookieFacade::queue($this->storeKey, serialize($cart));
    }

    /**
     * @param  array  $cart
     * @param  array  $item
     * @return array
     */
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

    /**
     * @param  array  $item
     * @param $amount
     * @return array
     */
    private function setAmountAndTotal(array $item, $amount): array
    {
        $item['amount'] = $amount;
        $item['total'] = $item['price'] * $item['amount'];

        return $item;
    }
}
