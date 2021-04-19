<?php

namespace aymakan;

class Client {


    private $config = array(
        'url'      => null,
        'apikey'   => null,
    );

    function __construct($url,$token) {
        $this->set_url($url);
        $this->set_token($token);
    }

    /**
     * This method will set url
     * @access protected
     * @param    $url
     */
    protected  function set_url($url) {
        $this->config ['url'] = $url;
    }

    /**
     * This method will fetch url
     * @access public
     */
    public function get_url() {
        return $this->config ['url'];
    }

    /**
     * This method will set token
     * @access protected
     * @param    $token
     */
    protected function set_token($token) {
        $this->config ['token'] = $token;
    }

    /**
     * This method will fetch token
     * @access public
     */
    public function get_token() {
        return  $this->config ['token'];
    }


    /**
     * This method will call API
     * @access public
     * @return  response
     * @param    $method   Request Method
     * @param    $url      Request URL
     * @param    $data     Request Parameter
     */
    protected function callAPI($method, $url, $data){

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
            'APIKEY:'.$this->config ['apikey'],
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
    public function getCityList(){
        $get_data = $this->callAPI('GET', $this->config['url'].'/cities', false);
        $response = json_decode($get_data, true);
        $cities =json_encode($response['data']);
        if (!$cities) {
            $cities =json_encode($response['errors']);
        }
        return $cities;
    }

}



?>
