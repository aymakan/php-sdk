<?php 
declare(strict_types=1);
namespace Aymakan;

use PHPUnit\Framework\TestCase;
require_once 'Aymakan/Client.php';


final class ClientTest extends TestCase
{
    public function testclientobjectcreated(): void
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
    
    public function testfetchcities(): void
    {
        try {
            $client = new Client();
            $client->setUrl('http://127.0.0.1:8000/api');
            $client->setToken('0c2b7458eaac670745bf1de00217c7c9-d008a330-5577-44df-a34b-b355c20cd5d8-d7ec25c503e66072837412ebf4b2ee86/5ec606d031e7ad7d18f772f51cf328d5/ba373c49-3c14-47e5-9460-78a418bc5034');
            $client->setEnv('Development');
            $this->assertTrue((bool)$client->getCityList());

         } catch (\Exception $expected) {
            $this->assertRegExp('/cities api does not call/i', strval($expected));
        }
    }

}

