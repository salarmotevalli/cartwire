<?php

namespace Cartwire\Core;

use Cartwire\Contracts\Item as ItemInterface;

class Item implements ItemInterface
{
    private array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}
