<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Define which configuration should be used
    |--------------------------------------------------------------------------
    */

    'use' => 'production',

    /*
    |--------------------------------------------------------------------------
    | AMQP properties separated by key
    |--------------------------------------------------------------------------
    */
    'properties' => [
        'production' => [
            'base_url'			=> env('RABBITMQ_HTTP_HOST', 'http://localhost:15672'),
            'username'        		=> env('RABBITMQ_LOGIN', 'guest'),
            'password'        		=> env('RABBITMQ_PASSWORD', 'guest'),
            'vhost'           		=> env('RABBITMQ_VHOST', '/'),
            'connect_options' 		=> [],
            'ssl_options'     		=> [],
        ],
    ],
];
