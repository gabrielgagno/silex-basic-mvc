<?php
require_once '../app/bootstrap/app.php';

$request = OAuth2\HttpFoundationBridge\Request::createFromGlobals();
$app->run($request);
