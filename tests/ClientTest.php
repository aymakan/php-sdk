<?php
declare(strict_types=1);
namespace Aymakan;

use PHPUnit\Framework\TestCase;
require_once 'src/Client.php';

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
            $client->setApikey('test_access_key');
            $this->assertEquals('test_access_key', $client->getToken());
            $client->setSandbox(true);
            $this->assertEquals(true, $client->isSandbox());
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
            $client->setSandbox();
            $response = $client->getCityList();
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array('143862','143892');
            $response = $client->trackShipment($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array('test-123shiiii3');
            $response = $client->shipmentByReference($data);
            $this->assertTrue((bool) $response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $trackingcode = '143866' ;
            $response = $client->getShipmentLabel($trackingcode);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array('AY120266','BY9437');
            $response = $client->getBulkShipmentLabel($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $response = $client->getCustomerShipments();
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $response = $client->getWebHook();
            var_dump($response);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array("webhook_url" => "https://testings.com");
            $response = $client->createWebHook($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array(
                "webhook_url" => "https://www.testings.com",
                "id" => "219"
            );
            $response = $client->updateWebHook($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
        }
    }

    /**
     * This method will test fetch address
     * @access public
     */
    public function testGetAddress(): void
    {
        try {
            $client = new Client();
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $response = $client->getAddress();
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
        }
    }

    /**
     * This method will test add  address
     * @access public
     */
    public function testCreateAddress(): void
    {
        try {
            $client = new Client();
            $client->setApikey('10c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array(
                "title" => "Aymkana",
                "name" => "test",
                "email" => "test@test.com",
                "city" => "Riyadh",
                "address" => "AL Yasmeen",
                "neighbourhood" => "Al Wizarat",
                "postcode" => "75760",
                "phone" => "+966598998110",
                "description" => "Home address"
            );
            $response = $client->createAddress($data);
            var_dump($response);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
        }
    }

    /**
     * This method will test update address
     * @access public
     */
    public function testUpdateAddress(): void
    {
        try {
            $client = new Client();
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array(
                "id" => "560",
                "title" => "Aymkana",
                "name" => "test",
                "email" => "test@test.com",
                "city" => "Riyadh",
                "address" => "AL Yasmeen",
                "neighbourhood" => "Al Wizarat",
                "postcode" => "75760",
                "phone" => "+966598998110",
                "description" => "Home address"
            );
            $response = $client->updateAddress($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);

        }
    }

    /**
     * This method will test delete address
     * @access public
     */
    public function testDeleteAddress(): void
    {
        try {
            $client = new Client();
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data = array('id' => 560);
            $response = $client->deleteAddress($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);

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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
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
                "reference" => "test-123shiiii3",
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
            var_dump($response);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
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
            $client->setApikey('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setSandbox();
            $data =  array("tracking" =>'AY358107280');
            $response = $client->cancelShipment($data);
            $this->assertTrue((bool)$response);
            $this->assertArrayHasKey('success', $response);
        } catch (\Exception $expected) {
            $this->fail("The Error is : ". $response['message']);
        }
    }
}

