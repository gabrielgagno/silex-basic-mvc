<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/21/16
 * Time: 9:57 PM
 */
namespace App\Controllers;

use OAuth2;
use Silex\Application;

class OAuthController
{
    /**
     * Returns an access token for the user
     * @param Application $app
     * @return mixed
     */
    public function authorize(Application $app)
    {
        $server = $app['oauth_server'];
        $response = $app['oauth_response'];
        return $server->handleTokenRequest($app['request'], $response);
    }
}