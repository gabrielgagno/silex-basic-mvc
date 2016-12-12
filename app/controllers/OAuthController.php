<?php
/**
 * OAuth2Controller.php
 * Contains the OAuthController class
 * @author Gabriel John P. Gagno
 * @version 1.0
 * @copyright 2016 Stratpoint Technologies, Inc.
 */
namespace App\Controllers;

use OAuth2;
use Silex\Application;

/**
 * Class OAuthController
 * Controller for handling OAuth 2.0-compliant operations
 * @package App\Controllers
 */
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