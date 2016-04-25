<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/22/16
 * Time: 4:04 PM
 */

namespace App\Libraries;

use Silex\Application;
use Silex\ControllerProviderInterface;
use OAuth2\Storage\Pdo as OAuth2PdoStorage;
use OAuth2\Server as OAuth2Server;
use OAuth2\GrantType\ClientCredentials;
use OAuth2\HttpFoundationBridge\Response as BridgeResponse;

class OAuth2Library implements ControllerProviderInterface
{
    public function setup(Application $app)
    {
        $storage = new OAuth2PdoStorage($this->constructDBString());

        $server = new OAuth2Server($storage, array('issuer' => $_SERVER['HTTP_HOST']));

        $server->addGrantType(new ClientCredentials($storage));

        $app['oauth_server'] = $server;

        $app['oauth_response'] = new BridgeResponse();
    }

    public function connect(Application $app)
    {
        $this->setup($app);

        $routing = $app['controllers_factory'];
        $routing->post('/accesstoken', 'App\\Controllers\\OAuthController::authorize');

        return $routing;
    }

    private function constructDBString()
    {
        return array(
            'dsn'       =>  getenv('DB_CONNECTION').':dbname='.getenv('DB_DATABASE').';host='.getenv('DB_HOST'),
            'username'  =>  getenv('DB_USERNAME'),
            'password'  =>  getenv('DB_PASSWORD')
        );
    }
}