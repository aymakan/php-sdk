<?php
declare(strict_types=1);
namespace Aymakan;

use PHPUnit\Framework\TestCase;
require_once 'Aymakan/Client.php';

final class ClientTest extends TestCase
{

    /**
     * This method will test client object creation
     * @access public
     */
    public function testClientObjectCreated(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $this->assertEquals('http://127.0.0.1:8000/api', $client->getUrl());
            $client->setToken('test_access_key');
            $this->assertEquals('test_access_key', $client->getToken());
            $client->setEnv('Development');
            $this->assertEquals('Development', $client->getEnv());
        } catch (\Exception $expected) {
            $this->assertRegExp('/client object does not created/i', strval($expected));
        }
    }

    /**
     * This method will test fetch cities data
     * @access public
     */
    public function testFetchCities(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $response = $client->getCityList();
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/cities api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test track shipment
     * @access public
     */
    public function testTrackShipment(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $trackingcode = 'AY120266';
            $response = $client->trackShipment($trackingcode);
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response) ;
        } catch (\Exception $expected) {
            $this->assertRegExp('/track shipment api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test fetch shipment by reference
     * @access public
     */
    public function testShipmentByReference(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');;
            $referencecode='user_60744b72691b8';
            $response = $client->shipmentByReference($referencecode);
            $this->assertTrue((bool) $response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/reference by shipment api does not call/i', strval($expected));
        }
    }


    /**
     * This method will test fetch shipment label data
     * @access public
     */
    public function testShipmentLabel(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $trackingcode = "AY131915";
            $response = $client->getShipmentLabel($trackingcode);
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/shipment label api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test fetch bulk shipment data
     * @access public
     */
    public function testBulkShipmentLabel(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $data = 'AY120266,BY9437';
            $response = $client->getBulkShipmentLabel($data);
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/bulk shipment label api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test fetch customer shipment data
     * @access public
     */
    public function testCustomerShipment(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $response = $client->getCustomerShipments();
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/customer shipment api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test fetch web hook
     * @access public
     */
    public function testGetWebhook(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $response = $client->getWebHook();
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/get web hook api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test add  web hook
     * @access public
     */
    public function testAddWebHook(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $data = array("webhook_url" => "https://testings.com");
            $response = $client->createWebHook($data);
            $this->assertTrue((bool)$response);
            $this->assertContains('webhook', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/add web hook api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test update web hook
     * @access public
     */
    public function testUpdateWebHook(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $data = array("webhook_url" => "https://www.testings.com",
                "id" => "205");
            $response = $client->updateWebHook($data);
            $this->assertTrue((bool)$response);
            $this->assertContains('data', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/update web hook api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test create shipment
     * @access public
     */
    public function testCreateShipment(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
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
            $this->assertTrue((bool)$response);
            $this->assertContains('reference', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/create shipment api does not call/i', strval($expected));
        }
    }

    /**
     * This method will test cancel shipment
     * @access public
     */
    public function testCancelShipment(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $data =  array("trackingcode" =>"AY120266");
            $response = $client->cancelShipment($data);
            $this->assertTrue((bool)$response);
            $this->assertContains('shipping', $response);
        } catch (\Exception $expected) {
            $this->assertRegExp('/cancel shipment api does not call/i', strval($expected));
        }
    }
}

