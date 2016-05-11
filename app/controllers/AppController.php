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
use App\Libraries\P2MEWrapper;


class AppController
{
    /**
     * Handles card link API calls
     * @param Application $app
     * @return Response
     */
    public function cardLink(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('CARD_LINK'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Request Fee API calls
     * @param Application $app
     * @return Response
     */
    public function requestFee(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('REQUEST_FEE'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Reset OTP API calls
     * @param Application $app
     * @return Response
     */
    public function resetOtp(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('RESET_OTP'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Reverse API Calls
     * @param Application $app
     * @return Response
     */
    public function reverse(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('REVERSE'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles Top UP API Calls
     * @param Application $app
     * @return Response
     */
    public function topUp(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('TOP_UP'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles transaction inquiry API calls
     * @param Application $app
     * @return Response
     */
    public function transactionInquiry(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('TRANSACTION_INQUIRY'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }

    /**
     * Handles validate mobile number API calls
     * @param Application $app
     * @return Response
     */
    public function validateMobileNumber(Application $app)
    {
        $p2meResponse = P2MEWrapper::requestHandler($app['monolog'], $app['request'], getenv('VALIDATE_MOBILE_NUMBER'), __FUNCTION__);
        $response = P2MEWrapper::responseHandler($app['monolog'], $p2meResponse->code, $p2meResponse);
        return $response;
    }
}