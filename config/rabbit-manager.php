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
            'base_url'			=> 'http://'.env('RABBITMQ_HOST', 'http://localhost').':'.env('RABBITMQ_MANAGEMENT_PORT'),
            'username'        		=> env('RABBITMQ_LOGIN', 'guest'),
            'password'        		=> env('RABBITMQ_PASSWORD', 'guest'),
            'vhost'           		=> env('RABBITMQ_VHOST', '/'),
            'connect_options' 		=> [],
            'ssl_options'     		=> [],
        ],
    ],
];