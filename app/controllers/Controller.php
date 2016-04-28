<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/28/16
 * Time: 4:11 PM
 */

namespace App\Controllers;

use Silex\Application;

class Controller
{
    protected function oauthGate(Application $app)
    {
        $server = $app['oauth_server'];
        $response = $app['oauth_response'];
        if (!$server->verifyResourceRequest($app['request'], $response)) {
            return $server->getResponse();
        }
        return true;
    }
}