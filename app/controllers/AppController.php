<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/3/16
 * Time: 9:25 AM
 */

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Unirest\Request as CurlRequest;


class AppController
{
    public function cardLink(Application $app, Request $request)
    {
        // TODO put validation here
        $p2meResponse = CurlRequest::get("http://localhost:3000/cardlink", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }

    public function requestFee(Request $request, Application $app)
    {
        // TODO validation procedure
        $p2meResponse = CurlRequest::get("http://localhost:3000/requestfees", null, null);
        $response = array(
            'status' => "success",
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }

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

    public function reverse(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/reverse", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }

    public function topUp(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/topup", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }

    public function transactionInquiry(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/transactioninquiry", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }

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

    private function handleResponse()
    {
        
    }
}