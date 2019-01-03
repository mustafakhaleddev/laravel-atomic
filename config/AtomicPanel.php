<?php

use MustafaKhaled\AtomicPanel\Http\Middleware\Authenticate;
use MustafaKhaled\AtomicPanel\Http\Middleware\Authorize;
use MustafaKhaled\AtomicPanel\Http\Middleware\AtomicServing;
use MustafaKhaled\AtomicPanel\Http\Middleware\DispatchServingAtomicEvent;
use MustafaKhaled\AtomicPanel\Http\Middleware\AtomicPageMiddleware;

return [


    /*
    |--------------------------------------------------------------------------
    | Atomic App Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to display the name of the application within the UI
    | or in other locations. Of course, you're free to change the value.
    |
    */
    'name' => 'Atomic Panel',

    /*
    |--------------------------------------------------------------------------
    | Atomic Path
    |--------------------------------------------------------------------------
    |
    | This is the URI path where Atomic will be accessible from. Feel free to
    | change this path to anything you like.
    |
    */
    "path" => '/atomic',


    /*
     |--------------------------------------------------------------------------
     | Atomic Authentication Guard
     |--------------------------------------------------------------------------
     |
     | This configuration option defines the authentication guard that will
     | be used to protect your Atomic routes. This option should match one
     | of the authentication guards defined in the "auth" config file.
     |
     */

    'guard' => env('ATOMIC_GUARD', null),


    /*
    |--------------------------------------------------------------------------
    | Atomic Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Panel route, giving you the
    | chance to add your own middleware to this stack or override any of
    | the existing middleware.
    |
    */
    'middleware' => [
        'web',
        Authenticate::class,
        DispatchServingAtomicEvent::class,
        AtomicServing::class,
        Authorize::class,

    ],

    /*
     |--------------------------------------------------------------------------
     | Atomic Pages Middleware
     |--------------------------------------------------------------------------
     |
     | These middleware will be assigned to every Pages route to authorize the page
     | giving you the chance to add your own middleware to this stack or override any of
     | the existing middleware.
     |
     */
    'pageMiddleware' => [
        AtomicPageMiddleware::class
    ]
];