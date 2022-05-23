<?php

namespace Controller;

class Api
{
    public $base_url;
    public function __construct()
    {
        $this->base_url = "http://192.168.65.145:3001/api/v1";
    }

    public function check_status()
    {
        $status = $this->CallAPI_Unauthorized('GET', '/users/login');
        if (\is_object($status) && property_exists($status, "statusCode")) {
            return true;
        }
        return false;
    }

    function CallAPI_Unauthorized($method, $url, $data = false)
    {
        $url = $this->base_url . $url;

        $curl = curl_init();

        if ($data)
            $data = json_encode($data);

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return json_decode($result);
    }

    function CallAPI($method, $url, $bearer_token, $data = false)
    {

        $url = $this->base_url . $url;

        $curl = curl_init();

        // Check if initialization had gone wrong*    
        if ($curl === false) {
            throw new \Exception('failed to initialize');
        }

        if ($data)
            $data = json_encode($data);

        switch ($method) {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            case "PATCH":
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'PATCH');

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        //curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
        $authorization = "Authorization: Bearer " . $bearer_token;

        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', $authorization));
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 50);

        $result = curl_exec($curl);

        // Check HTTP return code, too; might be something else than 200
        $httpReturnCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

        // Check the return value of curl_exec(), too
        if ($result === false) {
            \dump($curl);
            \dump($httpReturnCode);
        }

        curl_close($curl);




        return json_decode($result);
    }
}
