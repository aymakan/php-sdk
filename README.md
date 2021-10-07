# Aymakan PHP SDK
This is official Aymakan PHP SDK. It can be used to integrate with Aymakan APIs. The following features lists 
are available in this SDK.For more details about our API requests and responses [click here](https://developer.aymakan.com.sa/docs/1.0).

- Fetch Aymakan Cities List
- Create a Shipment
- Create a reverse pickup Shipment
- Get paginated list of Shipments
- Track shipments by tracking numbers
- Track shipments by reference numbers
- Print single shipment AWB
- Print multiple shipments AWBs
- Cancel Shipment
- Get Web Hook associated to account
- Create new web hook if there are no web hooks set at account
- Update webhook
- Fetch all addresses
- Create new address
- Update address
- Delete address

## Requirements

* PHP 7.1 or higher
* Curl 7.18 or higher

## Installing using Composer
```
composer require aymakan/php-sdk
```

## Getting Started

Your Aymakan access token are available in your customer dashboard account

Setting configuration while instantiating the Client object

Used for composer based installation

```php
<?php
// 1. Autoload the SDK Package. This will include all the files and classes to your autoloader'
// Used for composer based installation

require __DIR__  . '/vendor/autoload.php';

// Instantiate the client class
$client = new \Aymakan\Client();
// set token
$client->setApikey('ENTER-YOUR-API-KEY-HERE');
// set Sandbox testing mode
$client->setSandbox(true);

```

## Cities Method

Below is an example on how to fetch all cities through GetCities API call:

```php
<?php

$response = $client->getCityList();
echo $response . "\n";

```

[GetCities API Details](https://developer.aymakan.com.sa/docs/1.0/cities)

## Shipping Methods

### Track Shipping


Below is an example on how to track shipments through TrackShipment API call.
Shipments can be fetched as a single shipment or multiple shipments at the same time .
It is important to note that the tracking numbers should be sent in an array format.


#### Mandatory Parameter

| Parameter    | Type | Mandatory |
|--------------|----------------|----------------|
| Tracking Number  | Array  |  Yes  |


```php
//Track single shipment 
$response = $client->trackShipment(['AY120266']);

//Track multiple shipments
$response = $client->trackShipment(['AY669001659', '143862', '143866']);

echo $response . "\n";
```

[TrackShipment API Details](https://developer.aymakan.com.sa/docs/1.0/track-shipping)

### Fetch Shipment Using Reference

Below is an example on how to track shipments by reference number.
Shipments can be fetched by reference number as a single shipment or multiple shipments at the same time .
It is important to note that the reference number numbers should be sent in an array format.

#### Mandatory Parameter

| Parameter    |    Type    | Mandatory|
|--------------|----------------|----------------|
| Reference Number | Array    | Yes |


```php
//Track single shipment by reference number
$response = $client->shipmentByReference(['200018179']);

//Track Multiple shipment by reference number
$response = $client->shipmentByReference(['200018179','test-200018179']);

echo $response . "\n";
```

[Shipment By Reference API Details](https://developer.aymakan.com.sa/docs/1.0/shipments-by-reference)


### Create Shipping

Creates a new shipment , to find out more details about `request parameters` checkout our  
[Create Shipment API Documentation](https://developer.aymakan.com.sa/docs/1.0/create-shipping)
```php
$data = array(
 //request parameters
);

$response = $client->createShipment($data);
echo $response . "\n";
```
### Create a Reverse Pickup Shipping

Creates a reverse pickup shipment , to find out more details about `request parameters` checkout our  
[Create Reverse Pickup Shipment API Documentation](https://developer.aymakan.com.sa/docs/1.0/create-reverse-pickup-shipping)
```php
$data = array(
 //request parameters
);

$response = $client->createReversePickupShipment($data);
echo $response . "\n";
```

### Cancel Shipping


Below is an example of how to Cancel Shipment :


#### Mandatory Parameters

| Parameter    | variable name | Type | Mandatory|
|--------------|---------------|----------------|----------------|
| Tracking Number  | `tracking` | Array | Yes|


```php

$response = $client->cancelShipment(['tracking' => "AY120266"]);

echo $response . "\n";
```
[Cancel Shipment API Details](https://developer.aymakan.com.sa/docs/1.0/cancel-shipping)


### Shipping AWB label Printing


Below is an example on how to make the Shipping AWB label Printing API call.
This API requires a single tracking number associated with the customer account , and
returns a URL to download the pdf file for all AWB

#### Mandatory Parameters

| Parameter    | variable name |Type| Mandatory
|--------------|---------------|----------------|----------------
| Tracking Code  | `tracking_number` |String| Yes


```php

$response = $client->getShipmentLabel("AY120266");

echo $response . "\n";
```
[Shipping AWB label Printing API Details](https://developer.aymakan.com.sa/docs/1.0/shipping-awb-label)


### Bulk Shipping AWB label Printing

Below is an example on how get Bulk Shipping AWB label .
This API requires an array with tracking numbers associated with the customer account.
If all the tracking numbers are found for that associated account, 
this API returns a URL to download the pdf file for all AWB.

#### Mandatory Parameters

| Parameter     | Type |Mandatory|
|--------------|----------------|----------------|
| Tracking Number  | Array |Yes|


```php
//Get multiple shipment label
$client->getBulkShipmentLabel(['AY669001659', '143862', '143866', '143892']);

echo $response . "\n";
```
[Bulk Shipping AWB label Printing API Details](https://developer.aymakan.com.sa/docs/1.0/bulk-awb-labels)

### Customer Shipping


Below is an example on how to make the Customer Shipping  API call:

```php
$response = $client->getCustomerShipments();
echo $response . "\n";
```
[Customer Shipping  API Details](https://developer.aymakan.com.sa/docs/1.0/customer-shipping)



## Web Hooks

Web Hooks are a convenient way to receive real time updates for your shipments as soon as a status is updated. Web Hooks can be used to update customer internal systems with the latest shipments statuses.


### Get Webhooks

Below is an example on how to get webhooks .


```php
$response = $client->getWebHook();
echo $response . "\n";
```

[Get Webhooks API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-get)


### Add Webhook

Below is an example on how to add webhook .


#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| Web Hook URL  | `webhook_url` | Yes

```php

$data = array( "webhook_url" => "https://testings.com" );
 $response = $client->createWebHook($data);
echo $response . "\n";
```

[Add Webhook API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-add)


### Update Webhook

Below is an example on how to update Webhook .

#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| Web Hook URL  | `webhook_url` | Yes
| ID  | `id` | Yes


```php

$data = array(
    "id"=> 219 ,
    "webhook_url" => "https://www.testings.com"
);
 $response = $client->updateWebHook($data);
echo $response . "\n";
```

[Update Webhook API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-update)



## Addresses 

Manages address associated to customer account.


### Get Address

Fetches ALL addresses associated to customer account.

```php
$response = $client->getAddress();

echo $response . "\n";
```

[Get Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-get)




### Create Address

Below is an example on how to make the create address associated to customer account.

#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| Title  | `title` | Yes
|Name  | `name` | Yes
| Email  | `email` | Yes
| Address | `address` | Yes
| Neighbourhood  | `neighbourhood` | Yes
| Postcode  | `postcode` | Yes
| Phone  | `phone` | Yes
| Description  | `description` | Yes



```php
$data = array(
    "title" => "Mr",
    "name" => "Test",
    "email" => "test@aymakan.com.sa",
    "city" => "Riyadh",
    "address" => 123,
    "neighbourhood" => "Al-Sahafah",
    "postcode" => "11534",
    "phone" => 580000000,
    "description" => "Test User"
);

$response = $client->createAddress($data);
echo $response . "\n";


```

[Create Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-add)





### Update Address

Below is an example on how to update address associated to customer account.


#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| ID  | `id` | Yes
| Title  | `title` | Yes
|Name  | `name` | Yes
| Email  | `email` | Yes
| Address | `address` | Yes
| Neighbourhood  | `neighbourhood` | Yes
| Postcode  | `postcode` | Yes
| Phone  | `phone` | Yes
| Description  | `description` | Yes



```php
$data = array(
    "id" => "3",
    "title" => "Mr",
    "name" => "Test",
    "email" => "test@aymakan.com.sa",
    "city" => "Riyadh",
    "address" => 123,
    "neighbourhood" => "Al-Sahafah",
    "postcode" => "11534",
    "phone" => 580000000,
    "description" => "Test User"
);

$response = $client->createAddress($data);
echo $response . "\n";


```

[Update Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-update)




### Delete Address

Below is an example on how to delete an address associated to customer account.


#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| ID  | `id` | Yes


```php
$data = array(
    "id" => 544,
);

$response = $client->deleteAddress($data);
var_dump($response);

```

[Delete Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-delete)





