# Aymakan SDK (PHP)
Aymakan API Integration

## Requirements

* Aymakan  account


* PHP 7.1 or higher
* Curl 7.18 or higher

Support for PHP 7.0  is being deprecated. The SDK will work in these older environments, but future versions may not. We encourage merchants to move to a newer version of PHP at their earliest convenience.


## Installing using Composer
```
composer require aymakan/aymakan-sdk-php
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
├── tests
│   ├── ClientTest.php - Test Cases for Client API calls
├── README.md

```
## Parameters List

#### Mandatory Parameters
| Parameter    | variable name | Values          				|
|--------------|---------------|--------------------------------|
| URL          | `url`         | Default : `null`				|
| Access Token | `token`       | Default : `null`				|
| Environment  | `env`         | Default : `null`				|


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

$response = $client->getCityList();
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
        }
      ]
    }
}
```

### Shipping Methods

#### Track Shipping


Below is an example on how to make the TrackShipment API call:

#### Mandatory Parameter

| Parameter    |  variable name | Mandatory|
|--------------|---------------|----------------|
| Tracking Code  | `trackingids` | Yes |


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

$response = $client->shipmentByReference('AY120266');
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

#### Create Shipping


Below is an example on how to make the Create Shipping  API call:


####  Parameter


| Parameter                  | Type             | Mandatory   |     Description                                                                                                    |
|----------------------------|------------------|-------------|---------------------------------------------------------------------------------------------------------------     |
|  `requested_by`              | String          | Yes                 | The name of the person who is creating the shipping. It can be the employee name who is responsible for it
|  `declared_value`            | Decimal         | Yes                 | The amount of the order. This value is not visible on the shipping label.
|  `declared_value_currency`   | String          | No                  | The declared value currency. Default to SAR if no other currency is provided. Possible values are SAR, USD, AED. This value is not visible on the shipping label.
|  `reference `                | AlphaNumeric    | No                  | The order reference if available. It should be unique. If the reference number is already used a validation error will be returned The reference has already been taken
|  `is_cod  `                  | Numeric (Bool)  | No                  | If order is cash on delivery, set to 1. Default is 0.
|  `cod_amount`                | Decimal         | Conditional         | If is_cod is 1, then required, else optional. The COD amount which needs to be collected.
|  `currency`                  | String          | No                  | The currency of the amount. Default to SAR.
|  `delivery_name`             | String          | Yes                 | The delivery person name to whom that shipping will be delivered.
|  `delivery_city`             | String          | Yes                 | A predefined city name. Please check the Cities API.
|  `delivery_address`          | String          | Yes                 | Delivery address.
|  `delivery_neighbourhood`    | String          | Yes                 | City neighborhood for the  delivery.
|  `delivery_postcode`         | String          |  No                 | Delivery Post code
|  `delivery_country `         | String          | Yes                 | MISO Code for the country. Default to `SA` for Saudi Arabia
|  `delivery_phone `           | Number          | Yes                 | Delivery Phone Number. Only digits should be provided
|  `delivery_description`      | String          | No                  | Any specific delivery description for that shipping
|  `collection_name `          | String          | Yes                 | The main collection or entity or business name who is creating the shipping
|  `collection_email `         | String          | Yes                 | The collection email
|  `collection_city`           | String          | Yes                 | A predefined city name. Please check the Cities API.
|  `collection_address`        | String          | Yes                 | Collection point address, from where the shipping will be collected
|  `collection_neighbourhood`  | String          | No                  | City neighborhood for the Collection.
|  `collection_postcode`       | String          | No                  | Collection point post code
|  `collection_country`        | String          | Yes                 | ISO Code for the country. Default to SA for Saudi Arabia.
|  `collection_description`    | String          | No                  | Any description for the collection of the shipping.
|  `weight`                    | Decimal         | No                  | The weight of the shipment
|  `pieces`                    | Integer         | Yes                 | The total number of pieces that single shipping will have. For example, some shipping will have more items, which can’t be enclosed in a single packaging, so it is possible to pack them in multiple cartons. Those number of cartons means pieces here.
|  `items_count`               | Integer         | No                  | The total number of physical items in the shipment

```php

 $data = array(
    "requested_by" => "Test By Aymkana",
    "delivery_name" => "test",
    "delivery_city" => "Riyadh",
    "delivery_neighbourhood" => "Al Wizarat",
    "delivery_phone" => "+966598998110",
    "delivery_address" => "Saudi Arabia Makkah{Mecca} Jeddah Al Muntazahat شارع العام طريق الحرزات 03088",
    "collection_name" => "test",
    "collection_email" => "test@test.com",
    "collection_city" => "Riyadh",
    "collection_neighbourhood" => "Al Yasmin",
    "collection_phone" => 123123213,
    "collection_address" => "Test",
    "pieces" => 1,
    "cod_amount" => 200,
    "declared_value" => 123,
    "reference" => "test-123shi",
    "channel" => "magento",
    "destination" => array(
        "warehouse_id" => 3,
        "warehouse" => "JED"
    ),
    "origin" => array(
        "warehouse_id" => 1,
        "warehouse" => "RUH"
    ),
    "products" => array(
        array(
            "name" => "Test Item",
            "sku" => "1236",
            "qty" => 2,
            "price" => 125.23,
            "weight" => 12,
            "weight_unit" => "lb"
        ),
        array(
            "name" => "Test Item 2",
            "sku" => "12345",
            "qty" => 1,
            "price" => 15,
            "weight" => 1,
            "weight_unit" => "KG"
        )
    )
);
$response = $client->createShipment($data);
echo $response . "\n";
```
Sample JSON Response


```json
{
   "success": true,
   "data": {
     "shipping": {
       "requested_by": "Test",
       "declared_value": 345,
       "tracking_number": 235728,
       "status": "Submitted",
       "created_at": "2019-04-07 08:32:24",
       "label": "https://aymakan.com.sa/shipping/pdf/label/key/b16acf19-567b-46b1",
       "pdf_label": "https://aymakan.com.sa/shipping/pdf/label/key/b16acf19-567b-46b1",
       ...
     }
   }
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

$response = $client->getShipmentLabel("AY120266");
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
$response = $client->getCustomerShipments();
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

### Web Hooks

Web Hooks are a convenient way to receive real time updates for your shipments as soon as a status is updated. Web Hooks can be used to update customer internal systems with the latest shipments statuses.


#### Get Webhooks

Below is an example on how to make the Get Webhooks  API call:


```php
 $response = $client->getWebHook();
echo $response . "\n";
```

 Sample JSON Response

```json
 {
    "success": 1,
    "webhook": {
        "id": 195,
        "webhook_url": "https://testings.com",
        "call_method": "POST",
        "active": 1,
        "created_at": "2021-02-07 10:05:08",
        "updated_at": "2021-02-07 10:40:34"
    }
}
```


#### Add Webhook

Below is an example on how to make the Add Webhook  API call:


#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| Web Hook URL  | `webhook_url` | Yes

```php

$data = array( "webhook_url" => "https://testings.com" );
 $response = $client->createWebHook($data);
echo $response . "\n";
```
 Sample JSON Response

```json
 {
    "success": 1,
    "webhook": {
        "id": 195,
        "webhook_url": "https://testings.com",
        "call_method": "POST",
        "active": 1,
        "created_at": "2021-02-07 10:05:08",
        "updated_at": "2021-02-07 10:40:34"
    }
}
```



#### Update Webhook

Below is an example on how to make the Update Webhook API call:

#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| Web Hook URL  | `webhook_url` | Yes
| ID  | `id` | Yes


```php
$data = array( "webhook_url" => "https://www.testings.com" );
 $response = $client->updateWebHook($data);
echo $response . "\n";
```
 Sample JSON Response

```json
 {
    "success": 1,
    "webhook": {
        "id": 195,
        "webhook_url": "https://testings.com",
        "call_method": "POST",
        "active": 1,
        "created_at": "2021-02-07 10:05:08",
        "updated_at": "2021-02-07 10:40:34"
    }
}
```