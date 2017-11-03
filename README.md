# php-functions [![Build Status](https://travis-ci.org/adityasetiono/php-functions.svg?branch=master)](https://travis-ci.org/adityasetiono/php-functions)
Function helpers for PHP

# Installation
To install it with composer:
```shell
composer require adityasetiono/php-functions
```

# Usage
Import needed functions, for example:
```php
use function adityasetiono\util\{deserialize, serialize, generate_alphanumeric};
```
And to use it:
```php
$string = generate_alphanumeric(5);

// => "aR4z0"
```
