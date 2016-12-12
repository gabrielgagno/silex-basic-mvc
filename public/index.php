<?php

/**
 * index.php
 *
 * This file is the entry point to the P2ME API middleware
 * @author Gabriel John P. Gagno <ggagno@stratpoint.com>
 * @version 1.0
 * @copyright 2016 Stratpoint Technologies, Inc.
 */

# include bootstrapper file
require_once '../app/bootstrap/app.php';

# catch and create requests
$request = OAuth2\HttpFoundationBridge\Request::createFromGlobals();
$app->run($request);
