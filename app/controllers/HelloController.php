<?php
namespace App\Controllers;

use Silex\Application;
use OAuth2;

class HelloController extends Controller
{
    public function hello()
    {
        return "hello!";
    }

    public function get(Application $app)
    {
        $oAuthStatus = $this->oauthGate($app);
        if($oAuthStatus!==true) {
            return $oAuthStatus;
        }
        $result = $app['db']->fetchAssoc("select * from oauth_users");
        return $app->json($result, 200);
    }
}
?>
