<?php
namespace aymakan;

class Client {

    private $config = array(
        'url'      => null,
        'token'   => null,
        'env'   => null,
    );

    /**
     * This method will set url
     * @access public
     * @param    $url
     */
    public  function setUrl($url)
    {
        $this->config ['url'] = $url;
    }

    /**
     * This method will fetch url
     * @access public
     */
    public function getUrl()
    {
        return $this->config ['url'];
    }

    /**
     * This method will set token
     * @access public
     * @param    $token
     */
    public function setToken($token)
    {
        $this->config ['token'] = $token;
    }

    /**
     * This method will fetch token
     * @access public
     */
    public function getToken() {
        return  $this->config ['token'];
    }

    /**
     * This method will set environment
     * @access public
     * @param    $env
     */
    public function setEnv($env)
    {
        $this->config['env'] = $env;
    }

    /**
     * This method will fetch environment
     * @access public
     */
    public function getEnv()
    {
        return  $this->config['env'];
    }

    /**
     * This method will call API
     * @access public
     * @return  response
     * @param    $method   Request Method
     * @param    $url      Request URL
     * @param    $data     Request Parameter
     */
    public function callAPI($method, $url, $data)
    {

        $curl = curl_init();
        switch ($method){
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        // OPTIONS:
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Authorization:'. $this->config['token'],
            'Content-Type: application/json',
        ));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        // EXECUTE:
        $result = curl_exec($curl);
        if(!$result){die("Connection Failure");}
        curl_close($curl);
        return $result;
    }

    /**
     * This method will fetch city list
     * @access public
     */
    public function getCityList()
    {
        $get_data = $this->callAPI('GET', $this->config['url'].'/cities', false);
        $response = json_decode($get_data, true);
        $cities =json_encode($response['data']);
        if (!$cities) {
            $cities =json_encode($response['errors']);
        }
        return $cities;
    }

    /**
     * This method will track shipment
     * @access public
     */
    public function trackShipment($id)
    {
        $get_data = $this->callAPI('GET', $this->config['url'].'/shipping/track?trackingids='.$id, false);
        $response = json_decode($get_data, true);
        if(isset($response['error']))
        {
            $cities = json_encode($response['message']);
        }
        if(isset($response['data']))
        {
            $cities = json_encode($response['data']);
        }
        return $cities;
    }

}
?>