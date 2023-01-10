# Laravel ORM Cache
With this package you can easily cache  your database query. This packege will make faster your application.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nanopkg/laravel-orm-cache.svg?style=flat-square)](https://packagist.org/packages/nanopkg/laravel-orm-cache)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/nanopkg/laravel-orm-cache/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/nanopkg/laravel-orm-cache/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/nanopkg/laravel-orm-cache/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/nanopkg/laravel-orm-cache/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/nanopkg/laravel-orm-cache.svg?style=flat-square)](https://packagist.org/packages/nanopkg/laravel-orm-cache)


## Installation

You can install the package via composer:

```bash
composer require nanopkg/laravel-orm-cache
```


## Usage

Use OrmCache and set and orm cache key in your model
```php
use Nanopkg\OrmCache\Traits\OrmCache;

class Model
{
    use OrmCache; // import this class
    protected static $orm_cache_key = 'your key name here';
}
```

Get cache data by DESC formate
```php
Model::cacheData();
```

Get cache data by ASC formate
```php
Model::cacheDataASC();
```

Get cache table first Data
```php
Model::cacheDataFirst();
```

Get cache table Last Data
```php
Model::cacheDataLast();
```

Get cache table query
```php
Model::cacheDataQuery();
```

Forget cache
```php
Model::forgetCache();
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [RABIUL HASSAN](https://github.com/rabiulhassandev)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
