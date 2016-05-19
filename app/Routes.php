<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/19/16
 * Time: 3:23 PM
 */

namespace App;


use Silex\Application;
use Silex\ControllerProviderInterface;

class Routes implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $routing = $app['controllers_factory'];

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