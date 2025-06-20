# Testing toolkit for Laravel Nova.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/esign/laravel-nova-testing.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-nova-testing)
[![Total Downloads](https://img.shields.io/packagist/dt/esign/laravel-nova-testing.svg?style=flat-square)](https://packagist.org/packages/esign/laravel-nova-testing)
![GitHub Actions](https://github.com/esign/laravel-nova-testing/actions/workflows/main.yml/badge.svg)

A short intro about the package.

## Installation

You can install the package via composer:

```bash
composer require esign/laravel-nova-testing
```

The package will automatically register a service provider.

Next up, you can publish the configuration file:
```bash
php artisan vendor:publish --provider="Esign\NovaTesting\NovaTestingServiceProvider" --tag="config"
```

## Usage

### Testing

```bash
composer test
```

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
