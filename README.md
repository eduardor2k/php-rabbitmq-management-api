Laravel RabbitMQ Management Api
===========================

A simple object oriented wrapper for the [RabbitMQ Management HTTP Api](http://hg.rabbitmq.com/rabbitmq-management/raw-file/rabbitmq_v3_0_3/priv/www/api/index.html) in PHP 5.5.

Forked from 'richardfullmer/php-rabbitmq-management-api' in order to modernize the code and add tests.

Uses [Guzzle] 6 (http://guzzlephp.org) for REST requests.


### Requirements:
- php ~5.4.* 


Installation
------------

Installable through composer via:
====

First add package name to your composer requirements
```json
"require": {
    "mammutgroup/rabbitmq-management-api": "dev"
}
```

Next, update Composer from the Terminal:
>composer update

Next, add your new provider to the providers array of config/app.php:

```php
'providers' => [
    // ...
    Markup\RabbitMq\RabbitManagerServiceProvider::class
    // ...
  ]
```

Next, add class alias to the aliases array of config/app.php:

```php
'aliases' => [
   // ...
      'RabbitManager' => Markup\RabbitMq\Facades\RabbitManager::class,
    // ...
]
```

Finally, run:
> php artisan vendor:publish

Ho to use:
====
```php
  \RabbitManager::users()->all();
```



License
-------

php-rabbitmq-management-api is licensed under the MIT License - see the LICENSE file for details

Credits
-------

Structure from [KnpLabs php-github-api](https://github.com/KnpLabs/php-github-api)
Rabbit's [Excellent Message Queue](https://www.rabbitmq.com/)
