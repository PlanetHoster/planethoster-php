# PlanetHoster API Client
PHP library for [PlanetHoster API](https://apidoc.planethoster.com/)

[![CircleCI](https://dl.circleci.com/status-badge/img/gh/PlanetHoster/planethoster-php/tree/master.svg?style=svg)](https://dl.circleci.com/status-badge/redirect/gh/PlanetHoster/planethoster-php/tree/master)
[![Latest Stable Version](https://poser.pugx.org/planethoster/planethoster-api/v/stable)](https://packagist.org/packages/planethoster/planethoster-api)
[![Total Downloads](https://poser.pugx.org/planethoster/planethoster-api/downloads)](https://packagist.org/packages/planethoster/planethoster-api)
[![License](https://poser.pugx.org/planethoster/planethoster-api/license)](https://packagist.org/packages/planethoster/planethoster-api)

## Installation
We recommend to install this library with [composer](https://getcomposer.org/).

To install composer follow the [official documentation](https://getcomposer.org/doc/00-intro.md). The following command should also work:
```bash
curl -sS https://getcomposer.org/installer | php
```

To install the library, enter the following command in your PHP project directory:
```bash
composer require planethoster/planethoster-api
```

Or edit `composer.json` and add:
```json
{
    "require": {
        "planethoster/planethoster-api": "^1.0"
    }
}
```

## Adapter
Inspired by [toin0u/DigitalOceanV2](https://github.com/toin0u/DigitalOceanV2) design, we use `Adapter` interface to make the Http requests. 

By default, we provide an adapter for Guzzle with `GuzzleHttpAdapter`.

You can also build your own by implementing the `Adapter` interface.

## Example
```php
<?php

require __DIR__ . '/vendor/autoload.php';

use PlanetHoster\Adapter\GuzzleHttpAdapter;
use PlanetHoster\PlanetHoster;

// create an adapter with api_user and api_key
$adapter = new GuzzleHttpAdapter('your_api_user', 'your_api_key');

// create a PlanetHoster object
$planethoster = new PlanetHoster($adapter);

// Get your PlanetHoster account information
$infos = $planethoster->account()->Info();

// ...
```

## Credits
* [Gabriel Poulenard-Talbot](https://github.com/N0Cloud) for PlanetHoster

## Support
[Please open an issue in github](https://github.com/PlanetHoster/planethoster-php/issues)

## Resources
[PlanetHoster API documentation](https://apidoc.planethoster.com/)