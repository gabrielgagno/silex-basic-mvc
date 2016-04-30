<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/29/16
 * Time: 3:41 PM
 */

namespace App\Controllers;


use OAuth2\HttpFoundationBridge\Request;
use Silex\Application;
use Unirest\Request as CurlRequest;

class CardLinkController
{
    public function cardLink(Application $app, Request $request)
    {
        // TODO put validation here
        $p2meResponse = CurlRequest::get("http://localhost:3000/cardlink", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }
}