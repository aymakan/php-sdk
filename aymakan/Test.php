<?php
namespace aymakan;

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
?>