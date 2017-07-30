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
$ composer require rocketcode/requestlog
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
If you want to change any of the default options you can publish
 the migrations and the configuration.
```php
php artisan vendor:publish --provider RequestLogServiceProvider
```

### Usage
