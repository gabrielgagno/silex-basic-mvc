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

        $routing->get('/requestfee', 'App\\Controllers\\AppController::requestFee')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/cardlink', 'App\\Controllers\\AppController::cardlink')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/validatemobilenumber', 'App\\Controllers\\AppController::validateMobileNumber')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->get('/topup', 'App\\Controllers\\AppController::topUp')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/reverse', 'App\\Controllers\\AppController::reverse')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->get('/transactioninquiry', 'App\\Controllers\\AppController::transactionInquiry')->before('App\\Libraries\\OAuth2Library::handle');
        $routing->post('/resetotp', 'App\\Controllers\\AppController::resetOtp')->before('App\\Libraries\\OAuth2Library::handle');

        return $routing;
    }
}