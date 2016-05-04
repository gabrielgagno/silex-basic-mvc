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
    /**
     * Handles card link API calls
     * @param Application $app
     * @return Response
     */
    public function cardLink(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('CARD_LINK'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles Request Fee API calls
     * @param Application $app
     * @return Response
     */
    public function requestFee(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('REQUEST_FEE'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles Reset OTP API calls
     * @param Application $app
     * @return Response
     */
    public function resetOtp(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('RESET_OTP'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles Reverse API Calls
     * @param Application $app
     * @return Response
     */
    public function reverse(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('REVERSE'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles Top UP API Calls
     * @param Application $app
     * @return Response
     */
    public function topUp(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('TOP_UP'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles transaction inquiry API calls
     * @param Application $app
     * @return Response
     */
    public function transactionInquiry(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('TRANSACTION_INQUIRY'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles validate mobile number API calls
     * @param Application $app
     * @return Response
     */
    public function validateMobileNumber(Application $app)
    {
        $p2meResponse = $this->_handleRequest($app['request'], getenv('VALIDATE_MOBILE_NUMBER'), __FUNCTION__);
        $response = $this->_handleResponse($p2meResponse);
        return $response;
    }

    /**
     * Handles and formats responses returned by P2ME API calls
     * @param $p2meResponse
     * @return Response
     */
    private function _handleResponse($p2meResponse)
    {

        $code = $p2meResponse->code;
        $status = "fail";
        $message = null; // TODO replace all messages with simple p2meResponse->body later

        # This switch case handles responses sent by the P2ME API. Since the P2ME API does not send
        # exceptions whenever there are errors on its side (Internal Server errors are only sent as
        # is and will not trigger any exception on the middleware's part), it should be handled by
        # looking at the response code it sent and modify the response accordingly.
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

        return new Response(
            json_encode($response),
            $p2meResponse->code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }

    /**
     * Handles and customizes requests to be sent to P2ME API
     * @param $request
     * @param $url
     * @param $functionName
     * @return \Unirest\Response
     */
    private function _handleRequest($request, $url, $functionName)
    {
        return Request::get($url, array('x-id' => base64_encode($functionName.date('Y-m-d H:i:s'))), $request->request->all());
    }
}