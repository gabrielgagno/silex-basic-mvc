<?php
/**
 * Routes.php
 * Contains the Routes class
 * @author Gabriel John P. Gagno
 * @version 1.0
 * @copyright 2016 Stratpoint Technologies, Inc.
 */

namespace App;


use Silex\Application;
use Silex\ControllerProviderInterface;

/**
 * Class Routes
 * Contains all the user-defined routes for this application.
 * @package App
 */
class Routes implements ControllerProviderInterface
{
    /**
     * Contains and returns the defined routes to the calling function (mounting to instance of app)
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app)
    {
        $routing = $app['controllers_factory'];

        # Define all user-defined routes here

        $routing->get('/request-fee', 'App\\Controllers\\AppController::requestFee')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/card-link', 'App\\Controllers\\AppController::cardlink')->before('App\\Libraries\\OAuth2Library::handle');
        //$routing->post('/validate-mobile', 'App\\Controllers\\AppController::validateMobileNumber')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->get('/top-up', 'App\\Controllers\\AppController::topUp')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/reverse', 'App\\Controllers\\AppController::reverse')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->get('/transaction-inquiry', 'App\\Controllers\\AppController::transactionInquiry')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/reset-otp', 'App\\Controllers\\AppController::resetOtp')->before('App\\Libraries\\OAuth2Library::handle');

        return $routing;
    }
}