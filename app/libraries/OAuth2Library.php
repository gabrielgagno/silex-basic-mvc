<?php
/**
 * OAuth2Library.php
 * Contains the OAuth2Library class
 * @author Gabriel John P. Gagno
 * @version 1.0
 * @copyright 2016 Stratpoint Technologies, Inc.
 */

namespace App\Libraries;

use Silex\Application;
use Silex\ControllerProviderInterface;
use OAuth2\Storage\Pdo as OAuth2PdoStorage;
use OAuth2\Server as OAuth2Server;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\HttpFoundationBridge\Response as BridgeResponse;
use OAuth2\HttpFoundationBridge\Request as Request;

/**
 * Class OAuth2Library
 * Allows setup and initialization of the OAuth 2.0-compliant authentication service for this middleware
 * @package App\Libraries
 */
class OAuth2Library implements ControllerProviderInterface
{
    /**
     * Allows initial setup of the OAuth 2.0 Specification for this Middleware
     * @param Application $app
     */
    public function setup(Application $app)
    {
        $storage = new OAuth2PdoStorage($this->_constructDBString());

        $server = new OAuth2Server($storage, array('issuer' => $_SERVER['HTTP_HOST'], 'access_lifetime' => $app['access_lifetime']));

        $server->addGrantType(new ClientCredentials($storage));

        $app['oauth_server'] = $server;

        $app['oauth_response'] = new BridgeResponse();
    }

    /**
     * Executes setup function, allows this library to function as a service
     * @param Application $app
     * @return mixed
     */
    public function connect(Application $app)
    {
        $this->setup($app);

        $routing = $app['controllers_factory'];
        $routing->post('/accesstoken', 'App\\Controllers\\OAuthController::authorize');

        return $routing;
    }

    /**
     * Simple constructor of database connection 
     * @return array
     */
    private function _constructDBString()
    {
        return array(
            'dsn'       =>  getenv('DB_CONNECTION').':dbname='.getenv('DB_DATABASE').';host='.getenv('DB_HOST'),
            'username'  =>  getenv('DB_USERNAME'),
            'password'  =>  getenv('DB_PASSWORD')
        );
    }

    public function handle(Request $request, Application $app)
    {
        $server = $app['oauth_server'];
        $response = $app['oauth_response'];
        if(!$request->headers('Authorization')) {
            $response = array('error' => "invalid_token", 'error_description' => "Invalid token");
            return $app->json($response, 401, array('Content-Type' => 'application/json'));
        }
        if (!$server->verifyResourceRequest($app['request'], $response)) {
            return $response;
        }
        return null;
    }
}
