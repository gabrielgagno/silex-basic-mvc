<?php
require_once __DIR__.'/../vendor/autoload.php';

# initialize Silex Application Instance
$app = new Silex\Application();
$app->boot();

# register services

# register config service provider for entire app
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__."/../app/config/app.php"));

# register config service provder for database
$app->register(new Igorw\Silex\ConfigServiceProvider(__DIR__."/../app/config/database.php"));

# register logger service provider
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/log-'.date('Y-m-d').'.log',
    'monolog.name' => $app['name']
));

# register security service provider
$app->register(new Silex\Provider\SecurityServiceProvider());

# register validator provider (optional)
$app->register(new Silex\Provider\ValidatorServiceProvider());

# initialize environment here
try{
    $app['env'] = new Dotenv\Dotenv(__DIR__.'/../', '.env.'.$app['environment']);
    $app['env']->load();
}
catch (Exception $e) {
    $app->json(['error' => 500, 'error_description' => 'Environment Not Found'], 500)->send();
}

$app['debug'] = \App\Libraries\CoreHelpersLibrary::env('APP_DEBUG', false);

# routes
$app->get('/requestfee', 'App\\Controllers\\AppController::requestFee')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/cardlink', 'App\\Controllers\\AppController::cardlink')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/validatemobilenumber', 'App\\Controllers\\AppController::validateMobileNumber')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->get('/topup', 'App\\Controllers\\AppController::topUp')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/reverse', 'App\\Controllers\\AppController::reverse')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->get('/transactioninquiry', 'App\\Controllers\\AppController::transactionInquiry')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/resetotp', 'App\\Controllers\\AppController::resetOtp')->before('App\\Middleware\\OAuthMiddleware::handle');

# oauth routes
$app->mount('/oauth', new App\Libraries\OAuth2Library());


$request = OAuth2\HttpFoundationBridge\Request::createFromGlobals();
$app->run($request);
