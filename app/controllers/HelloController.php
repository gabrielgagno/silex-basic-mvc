<?php
namespace App\Controllers;

use Silex\Application;
use OAuth2;

class HelloController
{
    public function hello()
    {
        return "hello!";
    }

    public function get(Application $app)
    {
        $server = $app['oauth_server'];
        $response = $app['oauth_response'];
        if (!$server->verifyResourceRequest($app['request'], $response)) {
            return $server->getResponse();
        }
        else
        {
            $result = $app['db']->fetchAssoc("select * from oauth_users");
            return $app->json($result, 200);
        }
    }
}
?>
