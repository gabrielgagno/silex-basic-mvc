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
        $result = $app['db']->fetchAssoc("select * from oauth_users");
        return $app->json($result, 200);
    }
}
?>
