<?php
require_once 'vendor/autoload.php';
const HAPIKEY = "hapikey=eu1-b68e-599d-4807-a510-185ab00f80ee";
const OWNER_ID = "237972720";

class Requestor
{
    public function Reqest(string $link, string $requestType, array $postArr)
    {
        $requestType = strtoupper($requestType);
        if ($requestType == "GET") {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $link . HAPIKEY,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $requestType,
            ));

            $response = curl_exec($curl);

            curl_close($curl);

        }elseif ($requestType == 'POST'){
            $postArrJson = json_encode($postArr,true);

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $link. HAPIKEY,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => $requestType,
                CURLOPT_POSTFIELDS => $postArrJson,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            print_r($response);
        }
        return $response;
    }
}