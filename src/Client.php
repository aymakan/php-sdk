<?php

namespace Aymakan;

use Exception;

class Client
{

    private string $url = 'https://dev-api.aymakan.com.sa';
    private string $api_key = "";
    private bool $testing = false;


    /**
     * Set API Token
     * @param String $token
     */
    public function setApikey(string $token)
    {
        $this->api_key = $token;
    }

    /**
     * Get API Token
     * @return mixed
     */
    public function getToken()
    {
        return $this->api_key;
    }

    /**
     * Set Sandbox
     */
    public function setSandbox()
    {
        $this->testing = true;
        $this->url = 'https://dev-api.aymakan.com.sa/api';
    }

    /**
     * Get Sandbox
     * @return mixed
     */
    public function isSandbox()
    {
        return $this->testing;
    }


    /**
     * Call Aymakan API
     * @param $method
     * @param $url
     * @param $data
     * @return bool|string
     * @throws Exception
     */
    private function callAPI($method, $url = null, $data = false)
    {

        $curl = curl_init();
        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;

        }
        if ($data) {
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 100);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization:' . $this->api_key,
            'Content-Type: application/json',
            'Accept: application/json',
        ));
        // EXECUTE:
        $result = curl_exec($curl);
        if (!$result) {
            throw new Exception('Error in calling the API. ' . json_encode($result));
        }
        curl_close($curl);
        return json_decode($result, true);
    }

    /**
     * Get Aymakan cities list
     * @return array
     * @throws Exception
     */
    public function getCityList(): array
    {
        return $this->callAPI('GET', $this->url . '/cities');
    }

    /**
     * Track shipment by tracking number
     * @param string $tracking
     * @return bool|string
     * @throws Exception
     */
    public function trackShipment(array $tracking)
    {

        $tracking = implode(',', $tracking);
        return $this->callAPI('GET', $this->url . '/shipping/track/' . $tracking);
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
        return $this->callAPI('GET', $this->url . '/shipping/by_reference/' . $references);
    }

    /**
     * Get shipment label
     * @param $tracking
     * @return mixed
     * @throws Exception
     */
    public function getShipmentLabel($tracking)
    {
        return $this->callAPI('GET', $this->url . '/shipping/awb/tracking/' . $tracking);
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
        return $this->callAPI('GET', $this->url . '/shipping/bulk_awb/trackings/' . $tracking);
    }

    /**
     * This method will fetch customer shipments
     * @access public
     * @return mixed
     * @throws Exception
     */
    public function getCustomerShipments()
    {
        return $this->callAPI('GET', $this->url . '/customer/shipments');
    }

    /**
     * Creates a shipment
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createShipment($data)
    {
        return $this->callAPI('POST', $this->url . '/shipping/create', $data);
    }

    /**
     * Creates a reverse pickup shipment
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createReversePickupShipment($data)
    {
        return $this->callAPI('POST', $this->url . '/shipping/create/reverse_pickup', $data);
    }

    /**
     * Cancel a shipment
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function cancelShipment($data)
    {
        return $this->callAPI('POST', $this->url . '/shipping/cancel', $data);
    }

    /**
     * Get user account webhooks list
     * @return mixed
     * @throws Exception
     */
    public function getWebHook()
    {
        return $this->callAPI('GET', $this->url . '/webhooks/list');
    }

    /**
     * Create a webhook
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createWebHook($data)
    {
        return $this->callAPI('POST', $this->url . '/webhooks/create', $data);
    }

    /**
     * Updates a webhook
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function updateWebHook($data)
    {
        return $this->callAPI('PUT', $this->url . '/webhooks/update', $data);
    }


    /**
     * Get user account address list
     * @return mixed
     * @throws Exception
     */
    public function getAddress()
    {
        return $this->callAPI('GET', $this->url . '/address/list');
    }

    /**
     * Create  address
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createAddress($data)
    {
        return $this->callAPI('POST', $this->url . '/address/create', $data);
    }

    /**
     * Update  address
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function updateAddress($data)
    {
        return $this->callAPI('PUT', $this->url . '/address/update', $data);
    }

    /**
     * Delete  address
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function deleteAddress($data)
    {
        return $this->callAPI('DELETE', $this->url .'/address/delete',$data);
    }

    /**
     * Fetch all pickup requests by current user
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function pickupRequest()
    {
        return $this->callAPI('GET', $this->url .'pickup_request/list');
    }


    /**
     * Create a new pickup request
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function createPickupRequest($data)
    {
        return $this->callAPI('POST', $this->url .'pickup_request/create',$data);
    }

    /**
     * check the available time slots
     * @param $data
     * @return mixed
     * @throws Exception
     */
    public function timeSlots($data)
    {
        return $this->callAPI('GET', $this->url .'time_slots/'.$data);
    }
}
