# Aymakan PHP SDK
This is official Aymakan PHP SDK. It can be used to integrate with Aymakan APIs. The following features lists
are available in this SDK.For more details about our API requests and responses [click here](https://developer.aymakan.com.sa/docs/1.0).

- ### [General Methods](#general-methods-1)
    - [Ping API](#ping-api-method)
    - [Aymakan Cities](#cities-method)
- ### [Shipping Methods](#shipping-methods-1)
    - [Create shipping](#create-shipping)
    - [Create reverse pickup Shipping](#create-a-reverse-pickup-shipping)
    - [Track shipping](#track-shipping)
    - [Track shipping by reference](#track-shipping-using-reference)
    - [Cancel Shipping](#cancel-shipping)
    - [Cancel shipping by reference](#cancel-shipping-using-reference)
    - [Shipping AWB label](#shipping-awb-label-printing)
    - [Bulk shipping AWB labels](#bulk-shipping-awb-label-printing)
    - [Customer shipping](#customer-shipping)
- ### [Pickup Requests Methods](#pickup-requests-methods)
    - [Get pickup requests](#get-pickup-requests)
    - [Create pickup request](#create-pickup-request)
    - [Cancel pickup request](#cancel-pickup-request)
    - [Time slots](#time-slots)
- ### [Customer Addresses Methods](#customer-addresses-methods)
    - [Get Address](#get-address)
    - [Add Address](#create-address)
    - [Update address](#update-address)
    - [Delete address](#delete-address)
- ### [WebHooks Methods](#web-hooks-methods)
    - [Get Web hooks](#get-webhooks)
    - [Add Web Hook](#add-webhook)
    - [Update Web Hook](#update-webhook)
    - [Delete webhook](#delete-webhook)

------------------------------
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
------
## General Methods
### Ping API Method

Below is an example on how to fetch api status through ping API call:

```php
$response = $client->pingApi();
echo $response . "\n";
```

[Ping API Details](https://developer.aymakan.com.sa/docs/1.0/ping) <p align="right">(<a href="#top">back to top</a>)</p>


### Cities Method

Below is an example on how to fetch all cities through GetCities API call:

```php
$response = $client->getCityList();
echo $response . "\n";
```

[Cities API Details](https://developer.aymakan.com.sa/docs/1.0/cities) <p align="right">(<a href="#top">back to top</a>)</p>

----
## Shipping Methods

### Create Shipping

Creates a new shipment , to find out more details about `request parameters` checkout our  
[Create Shipping API Documentation](https://developer.aymakan.com.sa/docs/1.0/create-shipping)
```php
$data = array(
 //request parameters
);

$response = $client->createShipment($data);
echo $response . "\n";
```
 <p align="right">(<a href="#top">back to top</a>)</p>

### Create a Reverse Pickup Shipping

Creates a reverse pickup shipment , to find out more details about `request parameters` checkout our  
[Create Reverse Pickup Shipping API Documentation](https://developer.aymakan.com.sa/docs/1.0/create-reverse-pickup-shipping)
```php
$data = array(
 //request parameters
);

$response = $client->createReversePickupShipment($data);
echo $response . "\n";
```
<p align="right">(<a href="#top">back to top</a>)</p>

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

[Track Shipping API Details](https://developer.aymakan.com.sa/docs/1.0/track-shipping) <p align="right">(<a href="#top">back to top</a>)</p>

### Track Shipping Using Reference

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
<p align="right">(<a href="#top">back to top</a>)</p>

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
<p align="right">(<a href="#top">back to top</a>)</p>

### Cancel Shipping Using Reference

Below is an example on how to cancel shipments by reference number.
Shipments can be fetched by reference number as a single shipment or multiple shipments at the same time .
It is important to note that the reference number numbers should be sent in an array format.

#### Mandatory Parameter

| Parameter    |    Type    | Mandatory|
|--------------|----------------|----------------|
| Reference Number | Array    | Yes |


```php
# Track single shipment by reference number
$response = $client->cancelShipmentByReference(['200018179'])

# Track Multiple shipment by reference number
$response = $client->cancelShipmentByReference(['200018179','test-200018179'])

echo $response . "\n";
```

[Cancel shipment By Reference API Details](https://developer.aymakan.com.sa/docs/1.0/cancel-shipping-by-reference)
<p align="right">(<a href="#top">back to top</a>)</p>

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
<p align="right">(<a href="#top">back to top</a>)</p>

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
<p align="right">(<a href="#top">back to top</a>)</p>

### Customer Shipping


Below is an example on how to make the Customer Shippings API call:

```php
$response = $client->getCustomerShipments();
echo $response . "\n";
```
[Customer Shipping  API Details](https://developer.aymakan.com.sa/docs/1.0/customer-shipping)
<p align="right">(<a href="#top">back to top</a>)</p>

----
## Pickup Requests Methods
### Get Pickup Requests
This API fetches all current customer pickup requests.

```php
$response = $client->pickupRequest()
echo $response . "\n";
```
[Get Pickup Requests API Details](https://developer.aymakan.com.sa/docs/1.0/pickup-requests)
<p align="right">(<a href="#top">back to top</a>)</p>

### Create pickup request
Below is an example on how to create a pickup request.

| Parameter              | variable name     | Type      | Mandatory
|------------------------|-------------------|-----------|------------------------
| Date format should be "Y-m-d" | `pickup_date`     | String    | Yes
| Time slot              | `time_slot`       | String    | Yes
| The customer's name    | `contact_name`    | String    | Yes
| The customer's phone   | `contact_phone`   | String    | Yes
| The customer's address | `address`         | String    | Yes
| Amount of shipments    | `shipments`       | Integer   | Yes

```php
$data = array(
    "pickup_date" => "2022-12-02",
    "time_slot" => "afternoon",
    "contact_name" => "example",
    "contact_phone" => "059999999",
    "address" => "example address",
    "shipments" => 2
);

$response = $client->createPickupRequest($data)
echo $response . "\n";
```
[Create Pickup Request API Details](https://developer.aymakan.com.sa/docs/1.0/create-pickup-request)
<p align="right">(<a href="#top">back to top</a>)</p>

### Cancel pickup request
Below is an example on how to cancel a pickup request.

| Parameter         | variable name      | Type      | Mandatory
|-------------------|--------------------|-----------|------------------------
| Pickup request id | `pickup_request_id` | Integer | Yes | 

```php
$data = array(
    "pickup_request_id" => 4021
}

$response = $client->cancelPickupRequest($data)
echo $response . "\n";
```
[Cancel Pickup Request API Details](https://developer.aymakan.com.sa/docs/1.0/cancel-pickup-request)
<p align="right">(<a href="#top">back to top</a>)</p>

### Time slots
Below is an example on how to fetch all time slots available to current customer.

| Parameter         | variable name     | Type      | Mandatory
|-------------------|-------------------|-----------|------------------------
| Date format should be "Y-m-d" | `pickup_date` | String | Yes

```php
$response = $client->timeSlots("2022-12-02")
echo $response . "\n";
```
[Time Slots API Details](https://developer.aymakan.com.sa/docs/1.0/time-slots)
<p align="right">(<a href="#top">back to top</a>)</p>

-----
## Customer Addresses Methods

Manages address associated to customer account.


### Get Address

Fetches ALL addresses associated to customer account.

```php
$response = $client->getAddress();

echo $response . "\n";
```

[Get Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-get)
<p align="right">(<a href="#top">back to top</a>)</p>

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
    "name" => "example",
    "email" => "example@example.com",
    "city" => "Riyadh",
    "address" => 123,
    "neighbourhood" => "Al-Sahafah",
    "postcode" => "11534",
    "phone" => 0599999999,
    "description" => "create address example"
);

$response = $client->createAddress($data);
echo $response . "\n";
```

[Create Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-add)
<p align="right">(<a href="#top">back to top</a>)</p>

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
    "id" => 3,
    "title" => "Mr",
    "name" => "example",
    "email" => "example@example.com",
    "city" => "Riyadh",
    "address" => 123,
    "neighbourhood" => "Al-Sahafah",
    "postcode" => "11534",
    "phone" => 0599999999,
    "description" => "update address example"
);

$response = $client->updateAddress($data);
echo $response . "\n";
```

[Update Address API Details](https://developer.aymakan.com.sa/docs/1.0/customer-address-update)
<p align="right">(<a href="#top">back to top</a>)</p>

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
<p align="right">(<a href="#top">back to top</a>)</p>

----
## Web Hooks Methods

Web Hooks are a convenient way to receive real time updates for your shipments as soon as a status is updated. Web Hooks can be used to update customer internal systems with the latest shipments statuses.


### Get Webhooks

Below is an example on how to get webhooks .


```php
$response = $client->getWebHook();
echo $response . "\n";
```

[Get Webhooks API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-get)
<p align="right">(<a href="#top">back to top</a>)</p>

### Add Webhook

Below is an example on how to add webhook .


#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| Web Hook URL  | `webhook_url` | Yes

```php
$data = array(
    "webhook_url" => "https://testings.com" 
);

$response = $client->createWebHook($data);
echo $response . "\n";
```

[Add Webhook API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-add)
<p align="right">(<a href="#top">back to top</a>)</p>

### Update Webhook

Below is an example on how to update Webhook .

#### Mandatory Parameters

| Parameter    | variable name | Mandatory
|--------------|---------------|----------------
| ID  | `id` | Yes
| Web Hook URL  | `webhook_url` | Yes


```php
$data = array(
    "id"=> 219 ,
    "webhook_url" => "https://www.testings.com"
);

$response = $client->updateWebHook($data);
echo $response . "\n";
```

[Update Webhook API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-update)
<p align="right">(<a href="#top">back to top</a>)</p>

### Delete Webhook

Below is an example on how to delete webhooks .


```php
$response = $client->deleteWebHook()
echo $response . "\n";
```

[Delete Webhooks API Details](https://developer.aymakan.com.sa/docs/1.0/web-hooks-delete)
<p align="right">(<a href="#top">back to top</a>)</p>