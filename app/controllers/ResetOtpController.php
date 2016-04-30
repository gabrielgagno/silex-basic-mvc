<?php
/**
 * Created by IntelliJ IDEA.
 * User: Dell
 * Date: 5/1/2016
 * Time: 3:53 AM
 */

namespace App\Controllers;


use OAuth2\HttpFoundationBridge\Request;
use Silex\Application;
use Unirest\Request as CurlRequest;

class ResetOtpController
{
    public function resetOtp(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/resetOTP", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }
}