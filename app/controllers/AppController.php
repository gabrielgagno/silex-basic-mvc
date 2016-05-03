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
use Symfony\Component\HttpFoundation\Response;
use Unirest\Request as CurlRequest;


class AppController
{
    public function cardLink(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/cardlink", null, null);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function requestFee(Request $request, Application $app)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/requestfees", null, null);

        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function resetOtp(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/resetOTP", null, null);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function reverse(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/reverse", null, null);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function topUp(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/topup", null, null);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function transactionInquiry(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/transactioninquiry", null, null);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function validateMobileNumber(Application $app, Request $request)
    {
        $p2meResponse = CurlRequest::get("http://localhost:3000/validatemobilenumber", null, null);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    private function handleResponse($p2meResponse)
    {

        $code = $p2meResponse->code;
        $status = "fail";
        $message = null; // TODO replace all messages with simple p2meResponse->body later
        switch($code) {
            case 201:
                $message = "No Content";
                $status = "success";
                break;
            case 200:
                $message = $p2meResponse->body;
                $status = "success";
                break;
            case 400:
                $message = "Bad Request";
                break;
            case 401:
                $message = "Unauthorized";
                break;
            case 403:
                $message = "Forbidden";
                break;
            case 404:
                $message = "Not Found";
                break;
            case 500:
                $message = "Internal Server Error";
                break;
            case 502:
                $message = "Bad Gateway";
                break;
            case 503:
                $message = "Service Unavailable";
                break;
        }
        $response = array(
            "status"        => $status,
            "timestamp"     => date("Y-m-d H:i:s"),
            "p2me_result"   => $message
        );

        return $response;
    }
}