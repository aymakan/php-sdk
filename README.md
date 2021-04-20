# Aymakan SDK (PHP)
Aymakan API Integration

## Requirements

* Aymakan  account
 

* PHP 5.5 or higher
* Curl 7.18 or higher

Support for PHP 5.3 and 5.4 is being deprecated. The SDK will work in these older environments, but future versions may not. We encourage merchants to move to a newer version of PHP at their earliest convenience.


## Quick Start

The client takes in parameters in the following format:

1. Associative array

## Installing using Composer
```
```
## Directory Tree
```
.
├── composer.json - Configuration for composer
├── LICENSE.txt
├── NOTICE.txt
├── Aymakan
│   ├── Client.php - Main class with the API calls
│   ├── Test.php -  PHP SDK Test Sample
├── README.md

```
## Parameters List

#### Mandatory Parameters
| Parameter    | variable name | Values          				|
|--------------|---------------|------------------------------------------------|
| URL  | `url` | Default : `null`				|
| Access Token   | `token`  | Default : `null`				|
|Envinorment   | `env`  | Default : `null`				|


## Setting Configuration

Your Aymakan access token are available in your  account

Setting configuration while instantiating the Client object
```php
<?php
namespace aymakan;

require_once 'Client.php';

// Instantiate the client class
$client = new Client( );

// set URL
$client->setUrl('https://aymakan.com.sa/api/');
// set token
$client->setToken('12256664555');
// set environment
$client->setEnv('Production');

```
### Testing in Development Mode

The sandbox parameter is defaulted to false if not specified:
```php
<?php
namespace aymakan;

require_once 'Client.php';

// Instantiate the client class
$client = new Client( );

// set URL
$client->setUrl('https://aymakan.com.sa/api/');
// set token
$client->setToken('12256664555');
// set environment
$client->setEnv('Production');
```

### Making an API Call

Below is an example on how to make the GetCities API call:

```php
<?php

$response = $client->getCityList($);

```

 Sample Response

```json
{
  "success": true,
    "data": {
      "cities": [
        {
          "city_en": "Riyadh",
          "city_ar": "الرياض"
        },
        {
          "city_en": "Khobar",
          "city_ar": "الخبر"
        },
      ]
    }
}
```

### Shipping Methods

#### Track Shipping


Below is an example on how to make the TrackShipment API call:

```php

$response = $client->trackShipment('AY120266');
echo $response . "\n";
```
 Sample Response

```json
 {
   "success": true,
   "data": {
     "shipments": [
       {
         "tracking_number": "121",
         "requested_by": "Test",
         "price_set": "111",
         },
         ...
        ...
     ]
 }
```
