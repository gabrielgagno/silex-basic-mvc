<?php
/**
 * Created by IntelliJ IDEA.
 * User: gabrielgagno
 * Date: 5/4/16
 * Time: 12:04 PM
 */

namespace App\Libraries;

use Symfony\Component\HttpFoundation\Response;
use Unirest\Request;
use App\Libraries\LoggerLibrary;
class P2MEWrapper
{
    public static function requestHandler($request, $url, $functionName)
    {
        return Request::get($url, array('x-id' => base64_encode($functionName.date('Y-m-d H:i:s'))), json_encode($request->request->all()));
    }

    public static function responseHandler($code, $p2meResponse = null)
    {
        $status = "fail";
        $message = null; // TODO replace all messages with simple p2meResponse->body later

        # This switch case handles responses sent by the P2ME API. Since the P2ME API does not send
        # exceptions whenever there are errors on its side (Internal Server errors are only sent as
        # is and will not trigger any exception on the middleware's part), it should be handled by
        # looking at the response code it sent and modify the response accordingly.
        switch($code) {
            case 201:
                $message = "No Content";
                $status = "success";
                break;
            case 200:
                $message = $p2meResponse->body;
                $status = "success";
                break;
            case 400:
                $message = "Bad Request";
                break;
            case 401:
                $message = "Unauthorized";
                break;
            case 403:
                $message = "Forbidden";
                break;
            case 404:
                $message = "Not Found";
                break;
            case 500:
                $message = "Internal Server Error";
                break;
            case 502:
                $message = "Bad Gateway";
                break;
            case 503:
                $message = "Service Unavailable";
                break;
        }
        $response = array(
            "status"        => $status,
            "timestamp"     => date("Y-m-d H:i:s"),
            "p2me_result"   => $message
        );

        return new Response(
            json_encode($response),
            $code,
            array(
                'Content-type'  => 'application/json'
            )
        );
    }
}