<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/3/16
 * Time: 9:25 AM
 */

namespace App\Controllers;

use Silex\Application;
use Symfony\Component\HttpFoundation\Response;
use Unirest\Request;


class AppController
{
    public function cardLink(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/cardlink', __FUNCTION__);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function requestFee(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/requestfees', __FUNCTION__);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function resetOtp(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/resetOTP', __FUNCTION__);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function reverse(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/reverse', __FUNCTION__);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function topUp(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/topup', __FUNCTION__);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function transactionInquiry(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/transactioninquiry', __FUNCTION__);
        $response = $this->handleResponse($p2meResponse);
        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    public function validateMobileNumber(Application $app)
    {
        $p2meResponse = $this->handleRequest($app['request'], 'http://localhost:3000/validatemobilenumber', __FUNCTION__);
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

    private function handleRequest($request, $url, $functionName)
    {
        return Request::get($url, array('x-id' => base64_encode($functionName.date('Y-m-d H:i:s'))), $request->request->all());
    }
}