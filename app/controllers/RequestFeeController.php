<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 4/28/16
 * Time: 4:09 PM
 */

namespace App\Controllers;


use OAuth2\HttpFoundationBridge\Request;
use Silex\Application;
use Unirest\Request as CurlRequest;

class RequestFeeController extends Controller
{
    public function requestFee(Request $request, Application $app)
    {
        // TODO validation procedure
        $p2meResponse = CurlRequest::get("http://localhost:3000/requestfees", null, null);
        $response = array(
            'status' => 10,
            'timestamp' => date('Y-m-d H:i:s'),
            'p2me_result'   => $p2meResponse->body
        );
        return $app->json($response);
    }
}