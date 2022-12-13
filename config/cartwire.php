<?php

use Cartwire\Core\Enums\TableColumnStatus;

return [

    /*
     * with this item you can specific which one of models can be on the cart
     */

    'cart-page-route' => 'cart',

    'store-key' => 'cartwire',

    'driver' => Cartwire\Storage\Cooki::class, // database, cookie, session

    'table-columns' => [
        'name' => TableColumnStatus::REQUIRED->value,
        'created_at' => TableColumnStatus::NULLABLE->value,
    ],

    // TODO: 'notification' => true,

    'nav-item-name' => 'Cart',

];
