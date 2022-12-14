<?php

use Cartwire\Core\Enums\TableColumnStatus;

return [

    //-------------------------------------------------------------
    // Url path

    'cart-page-route' => 'cart',

    //-------------------------------------------------------------
    // The key for save cart in session or cookie

    'store-key' => 'cartwire',

    //-------------------------------------------------------------
    // Storing  driver

    'driver' => Cartwire\Storage\Session::class, // cookie, session

    //-------------------------------------------------------------
    // Table columns and their display stats

    'table-columns' => [
        'name' => TableColumnStatus::REQUIRED->value,
        'created_at' => TableColumnStatus::NULLABLE->value,
    ],

    //-------------------------------------------------------------
    // Navigation item name

    'nav-item-name' => 'Cart',

    //-------------------------------------------------------------
    // Notification status
    //
     'notification' => true,

];
