<?php
namespace Aymakan;

use Exception;

class Client
{

    /**
     * @var array
     */
    private $config = [
        'url'      => 'https://aymakan.com.sa/api/',
        'token'   => null,
        'testing'   => false,
    ];

    /**
     * Set API Token
     * @param $token
     */
    public function setToken($token)
    {
        $this->config ['token'] = $token;
    }

    /**
     * Get API Token
     * @return mixed
     */
    public function getToken()
    {
        return $this->config ['token'];
    }

    /**
     * Set Sandbox
     */
    public function setSandbox()
    {
        $this->config['testing'] = true;
        $this->config['url'] = 'https://dev-api.aymakan.com.sa/api';
    }

    /**
     * Get Sandbox
     * @return mixed
     */
    public function getSandbox()
    {
        return  $this->config['testing'];
    }


    /**
     * Call Aymakan API
     * @param $method
     * @param $url
     * @param $data
     * @return bool|string
     * @throws Exception
     */
    private function callAPI($method, $url, $data = false)
    {
        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data) {
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                }
                break;
            default:
                if ($data) {
                    $url = sprintf("%s?%s", $url, http_build_query($data));
                }
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization:'. $this->config['token'],
            'Content-Type: application/json',
            'Accept: application/json',
        ));
        // EXECUTE:
        $result = curl_exec($curl);
        if(! $result) {
            throw new Exception('Error in calling the API. '.json_encode($result));
        }
        curl_close($curl);
        return json_decode($result, true);
    }

    /**
     * Get Aymakan cities list
     * @return array
     * @throws Exception
     */
    public function getCityList() : array
    {
        return $this->callAPI('GET', $this->config['url'].'/cities');
    }

    /**
     * Track shipment by tracking number
     * @param array $tracking
     * @return bool|string
     * @throws Exception
     */
    public function trackShipment(array $tracking)
    {
        $tracking = implode(',', $tracking);
        return $this->callAPI('GET', $this->config['url'].'/shipping/track?trackingids='.$tracking);
    }

    /**
     * Get shipment by reference
     * @param array $references
     * @return bool|string
     * @throws Exception
     */
    public function shipmentByReference(array $references)
    {
        $references = implode(',', $references);
        return $this->callAPI('GET', $this->config['url'].'/shipping/by_reference?referencecodes='.$references);
    }

    /**
     * Get shipment label
     * @param $tracking
     * @return mixed
     * @throws Exception
     */
    public function getShipmentLabel($tracking)
    {
        return $this->callAPI('GET', $this->config['url'].'/shipping/awb/tracking?tracking_number='.$tracking);
    }

    /**
     * Get multiple shipments label
     * @param $tracking
     * @return mixed
     * @throws Exception
     */
    public function getBulkShipmentLabel(array $tracking)
    {
        $tracking = implode(',', $tracking);
        return $this->callAPI('GET', $this->config['url'].'/shipping/bulk_awb/trackings?tracking_codes='.$tracking);
    }

    /**
     * This method will fetch customer shipments
     * @access public
     * @return mixed
     * @throws Exception
     */
    public function getCustomerShipments()
    {
        return $this->callAPI('GET', $this->config['url'].'/customer/shipments');
    }

    /**
     * Creates a shipment
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createShipment($data)
    {
        return $this->callAPI('POST', $this->config['url'].'/shipping/create', json_encode($data));
    }

    /**
     * Cancel a shipment
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function cancelShipment($data)
    {
        return $this->callAPI('POST', $this->config['url'].'/shipping/cancel', json_encode($data));
    }

    /**
     * Get user account webhooks list
     * @return mixed
     * @throws Exception
     */
    public function getWebHook()
    {
        return $this->callAPI('GET', $this->config['url'].'/webhooks/list');
    }

    /**
     * Create a webhook
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createWebHook($data)
    {
        return $this->callAPI('POST', $this->config['url'].'/webhooks/create', json_encode($data));
    }

    /**
     * Updates a webhook
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function updateWebHook($data)
    {
        return $this->callAPI('PUT', $this->config['url'].'/webhooks/update', json_encode($data));
    }


    /**
     * Get user account address list
     * @return mixed
     * @throws Exception
     */
    public function getAddress()
    {
        return $this->callAPI('GET', $this->config['url'].'/address/list');
    }

    /**
     * Create  address
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createAddress($data)
    {
        return $this->callAPI('POST', $this->config['url'].'/address/create', json_encode($data));
    }

    /**
     * Update  address
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function updateAddress($data)
    {
        return $this->callAPI('PUT', $this->config['url'].'/address/update', json_encode($data));
    }

    /**
     * Delete  address
     * @param $id
     * @return mixed
     * @throws Exception
     */
    public function deleteAddress($id)
    {
        return $this->callAPI('DELETE', $this->config['url'].'/address/delete?id='.$id, false);
    }
}
