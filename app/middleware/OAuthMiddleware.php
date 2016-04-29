<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/28/16
 * Time: 5:41 PM
 */

namespace App\Middleware;

use OAuth2\HttpFoundationBridge\Request;
use Silex\Application;

class OAuthMiddleware
{
    public function handle(Request $request, Application $app)
    {
        $server = $app['oauth_server'];
        $response = $app['oauth_response'];
        if (!$server->verifyResourceRequest($app['request'], $response)) {
            return $server->getResponse();
        }
        return null;
    }
}