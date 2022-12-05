<?php
return [

    /*
     * with this item you can specific which one of models can be on the cart
     */
    'cart-page-route' => 'cart',

    'model' => \App\Models\User::class,


    'template' => 'tailwind', // tailwind, bootstrap


    'store' => 'session', // database, cookie, session


    'table' => [
        'name', 'created_at'
    ],


    'price' => 'id', //set the column of table that demonstrate price


    'notification' => true,

    'nav-item-name' => 'Cart',

];
