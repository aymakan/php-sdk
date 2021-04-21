<?php
namespace Aymakan;

require("Client.php");

$client = new Client();
// set url
$client->setUrl('http://127.0.0.1:8000/api');
// set token
$client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
// set environment
$client->setEnv('Development');
// get city list
$client->getCityList();
// track shipment
$client->trackShipment('AY120266');
// track shipment by reference
$client->shipmentByReference('user_60744b72691b8');
//  shipment label
$client->getShipmentLabel('AY131915');
// bulk shipment label
$client->getBulkShipmentLabel('AY120266,BY9437');
// customer shipments 
$client->getCustomerShipments();
//cancel shipment
$data =  array("trackingcode" =>"AY120266" );
$client->cancelShipment($data);
//create shipment
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
$client->createShipment($data);
//get web hook
$client->getWebHook();
//create web hook
$data = array("webhook_url" => "https://testings.com");
$client->createWebHook($data);
//update web hook
$data = array("webhook_url" => "https://www.testings.com", "id" => "123");
$client->updateWebHook($data);
?>