<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/29/16
 * Time: 11:00 AM
 */

namespace App\Libraries;


class CurlLibrary
{
    public static function curlRequest($url, $requestType = 'GET', array $headers = array(), array $postFields = array())
    {
        $ch = curl_init($url);
        curl_setopt_array($ch, array(
            CURLOPT_CUSTOMREQUEST => $requestType,
            CURLOPT_HTTPHEADER  => $headers,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_POSTFIELDS => $postFields
        ));
        $response = curl_exec($ch);
        $decodedResponse = json_decode($response);
        curl_close($ch);
        return $decodedResponse;
    }
}