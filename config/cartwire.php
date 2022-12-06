<?php

use Salarmotevalli\CartWire\Enums\TableColumnStatus;

return [

    /*
     * with this item you can specific which one of models can be on the cart
     */
    'cart-page-route' => 'cart',

    'model' => \App\Models\User::class,


    'template' => 'tailwind', // tailwind, bootstrap


    'store' => 'session', // database, cookie, session


    'table' => [
        'name' => TableColumnStatus::REQUIRED,
        'named' => TableColumnStatus::REQUIRED,
        'created_at' => TableColumnStatus::NULLABLE,
        'created_a' => TableColumnStatus::NULLABLE,
    ],


    'price' => 'id', //set the column of table that demonstrate price


    'notification' => true,

    'nav-item-name' => 'Cart',

];
