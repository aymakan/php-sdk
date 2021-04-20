# Aymakan SDK (PHP)
Aymakan API Integration

## Requirements

* Aymakan  account
 

* PHP 5.6 or higher
* Curl 7.18 or higher

Support for PHP 5.5  is being deprecated. The SDK will work in these older environments, but future versions may not. We encourage merchants to move to a newer version of PHP at their earliest convenience.

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
| Environment   | `env`  | Default : `null`				|


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
$client->setUrl('https://dev.aymakan.com.sa/api/');
// set token
$client->setToken('12256664555');
// set environment
$client->setEnv('Development');
```

### Making an API Call

Below is an example on how to make the GetCities API call:

```php
<?php

$response = $client->getCityList($);
echo $response . "\n";

```

 Sample JSON Response

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

#### Mandatory Parameter

| Parameter    | variable name | Mandatory                
|--------------|---------------|----------------
| Tracking Code  | `trackingids` | Yes  


```php

$response = $client->trackShipment('AY120266');
echo $response . "\n";
```
 Sample JSON Response

```json
 {
   "success": true,
   "data": {
     "shipments": [
       {
         "tracking_number": "121",
         "requested_by": "Test",
         "price_set": "111"
           ...
         },
        ...
     ]
 }
```

#### Fetch Shipment Using Reference


Below is an example on how to make the Shipment By Reference API call:


#### Mandatory Parameter

| Parameter    | variable name | Mandatory                
|--------------|---------------|----------------
| Reference Code  | `referencecodes` | Yes  



```php

$client->shipmentByReference('AY120266');
echo $response . "\n";
```
 Sample JSON Response

```json
  {
   "success": true,
   "data": {
     "shipments": [
       {
         "tracking_number": "121",
         "requested_by": "Test",
         "price_set": "111",
         ...
         },
         ...
     ]
   }
```

#### Cancel Shipping


Below is an example on how to make the Cancel Shipment  API call:


#### Mandatory Parameters

| Parameter    | variable name | Mandatory                
|--------------|---------------|----------------
| Tracking Code  | `trackingcode` | Yes  



```php

$data =  array("trackingcode" =>"AY120266" );

$client->cancelShipment($data);
echo $response . "\n";
```
 Sample JSON Response

```json
  {
   "success": true,
   "message": "Shipping is cancelled successfully"
 }
```


#### Shipping AWB label Printing 


Below is an example on how to make the Shipping AWB label Printing  API call:


#### Mandatory Parameters

| Parameter    | variable name | Mandatory                
|--------------|---------------|----------------
| Tracking Code  | `tracking_number` | Yes  



```php


$client->getShipmentLabel("AY120266");
echo $response . "\n";
```
 Sample JSON Response

```json
  {
   "success": true,
   "data": {
     "bulk_awb_url": "https://aymakan.com.sa/pdf/generate/3eb-416a-a3b8-7d2f3002d33"
   }
 }
```




#### Shipping AWB label Printing 


Below is an example on how to make the Bulk Shipping AWB label Printing  API call:


#### Mandatory Parameters

| Parameter    | variable name | Mandatory                
|--------------|---------------|----------------
| Tracking Code  | `tracking_codes` | Yes  



```php


$client->getBulkShipmentLabel("AY120266,256666");
echo $response . "\n";
```
 Sample JSON Response

```json
  {
   "success": true,
   "data": {
     "bulk_awb_url": "https://aymakan.com.sa/pdf/generate/3eb-416a-a3b8-7d2f3002d33"
   }
 }
```


#### Customer Shipping 


Below is an example on how to make the Customer Shipping  API call:


```php

$client->getCustomerShipments();
echo $response . "\n";
```
 Sample JSON Response

```json
  {
  "current_page": 1,
  "data": [
       {
          "tracking_number": "341775",
          "reference": "110347",
           "status": "Out for Return to Shipper",
           "updated_at": "2020-01-06 16:12:58"
       },
       {
           "tracking_number": "341772",
           "reference": "110358",
           "status": "Delivered",
           "updated_at": "2019-12-29 00:32:09"
       },
       {
           "tracking_number": "341770",
           "reference": "110341",
           "status": "Received at Warehouse",
           "updated_at": "2020-01-01 22:41:37"
       },
       ...
    ],
    "first_page_url": "https://dev.aymakan.com.sa/api/v2/customer/shipments?page=1",
    "from": 1,
    "last_page": 100,
    "last_page_url": "https://dev.aymakan.com.sa/api/v2/customer/shipments?page=100",
    "next_page_url": "https://dev.aymakan.com.sa/api/v2/customer/shipments?page=2",
    "path": "https://dev.aymakan.com.sa/api/v2/customer/shipments",
    "per_page": 100,
    "prev_page_url": null,
    "to": 100,
    "total": 10000 
}
```