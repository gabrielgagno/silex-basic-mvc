<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/29/16
 * Time: 6:27 PM
 */

namespace App\Controllers;


use OAuth2\HttpFoundationBridge\Request;
use Silex\Application;
use Unirest\Request as CurlRequest;

class ValidateMobileNumberController
{
    public function validateMobileNumber(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/validatemobilenumber", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }
}