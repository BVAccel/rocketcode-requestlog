<h2 align="center">
   <img src="https://raw.githubusercontent.com/RocketCodeHQ/logos/master/rc-logo.png"><br>Progress
</h2>

<p align="center">
    <a href="https://styleci.io/repos/92856894">
        <img src="https://styleci.io/repos/98772557/shield?branch=master" alt="StyleCI">
    </a>
</p>

## Introduction
Rocketcode RequestLog is a thing you need.

## License
This package is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT).

### Installation
Install RequestLog as you would with any other dependency managed by Composer:

```bash
$ composer require rocketcodehq/requestlog
```

### Configuration
After installing just register the ```Rocketcode\RequestLog\RequestLogServiceProvider::class``` in your `config/app.php` configuration file.  

```php
'providers' => [
    ...
    Rocketcode\RequestLog\RequestLogServiceProvider::class
]
```

### Publishing 
Publish and run the migration.  This will also publish the config options
and you can modify them to your need.
```php
php artisan vendor:publish --provider RequestLogServiceProvider
php artisan migrate
```

### Usage
Register the middleware.  Depending on your desires you can set it in either
the global section or the routed section of your Http/Kernel.php
```php

// Global
protected $middleware = [
    ...
	\Rocketcode\RequestLog\Http\Middleware\RequestLogMiddleware::class,
];

// Routed
protected $routeMiddleware = [
    ...
    'requestlog' => \Rocketcode\RequestLog\Http\Middleware\RequestLogMiddleware::class,
];

```