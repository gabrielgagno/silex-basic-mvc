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
use App\Libraries\CurlLibrary;

class RequestFeeController extends Controller
{
    public function requestFee(Request $request, Application $app)
    {
        // TODO validation procedure
        $response = CurlLibrary::curlRequest("http://localhost:3000/requestfees", 'GET', null, null);
        die($response);
    }
}