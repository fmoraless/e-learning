<?php

/**
 * Copyright (c) Vincent Klaiber.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @see https://github.com/vinkla/laravel-hashids
 */

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Order;
use App\Models\Unit;
use App\Models\User;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Connection Name
    |--------------------------------------------------------------------------
    |
    | Here you may specify which of the connections below you wish to use as
    | your default connection for all work. Of course, you may use many
    | connections at once using the manager class.
    |
    */

    'default' => 'main',

    /*
    |--------------------------------------------------------------------------
    | Hashids Connections
    |--------------------------------------------------------------------------
    |
    | Here are each of the connections setup for your application. Example
    | configuration has been included, but you may add as many connections as
    | you would like.
    |
    */

    'connections' => [

        User::class => [
            'salt' => User::class.'fe4898dfe2fb8422f6dc8f79146d214d',
            'length' => 10,
        ],

        Course::class => [
            'salt' => Course::class.'6dc29bf420a127578beaacab45f41351',
            'length' => 8,
        ],
        Unit::class => [
            'salt' => Unit::class.'c91a52c63222c1080a104b21f3331a60',
            'length' => 12,
        ],
        Coupon::class => [
            'salt' => Coupon::class.'169c2a908fe5a90a03e9992002a90fc8',
            'length' => 6,
        ],
        Order::class => [
            'salt' => Order::class.'a7d111409c5df4c897523b82e0d0d91e',
            'length' => 10,
        ],
        Category::class => [
            'salt' => Category::class.'6dc29bf420a127578beaacab45f41351',
            'length' => 8,
        ],
    ],

];
