<?php

namespace Salarmotevalli\CartWire\Tests\Feature;

use Illuminate\Support\Facades\Session;
use Livewire\Livewire;
use Salarmotevalli\CartWire\Http\Livewire\CartPage;

class CartPageTest extends \Tests\TestCase
{
    public function test_cart_page()
    {
        $response = $this->withSession(['cart'])->get('/cart');
        $response->assertStatus(200);
        $this->get('/cart')
            ->assertSeeLivewire('CartPage');

    }
}
