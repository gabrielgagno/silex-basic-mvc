<?php
require_once __DIR__.'/../vendor/autoload.php';

//initialize Silex Application Instance
$app = new Silex\Application();
$app->boot();
$app['environment'] = 'local'; // initialize app environment here

//initialize dotenv
$app['env'] = new Dotenv\Dotenv(__DIR__.'/../', '.env.'.$app['environment']);
$app['env']->load();
$app['debug'] = getenv('APP_DEBUG')?getenv('APP_DEBUG'):true;
//register services

//register doctrine db provider
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'dbname' => getenv('DB_DATABASE'),
        'user'   => getenv('DB_USERNAME'),
        'host'     => getenv('DB_HOST'),
        'driver'   => getenv('DB_DRIVER')
    ),
));

//register logger service provider
$app->register(new Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../logs/log-'.date('Y-m-d').'.log',
    'monolog.name' => 'p2me_api'
));

//register security service provider
$app->register(new Silex\Provider\SecurityServiceProvider());

//register validator provider (optional)
$app->register(new Silex\Provider\ValidatorServiceProvider());

//register error handler
/*
$app->error(function(\Exception $e, $code) {
    $status = null;
    switch ($code) {
        case 500:
            $status = array(
                "status"        => "fail",
                "timestamp"     => date('Y-m-d H:i:s'),
                "p2me_result"   => "Internal Server Error"
            );
            return new \Symfony\Component\HttpFoundation\Response(json_encode($status), $code, array('content-type' => 'application/json'));
            break;
        case 404:
            $status = array(
                "status"        => "fail",
                "timestamp"     => date('Y-m-d H:i:s'),
                "p2me_result"   => "Resource Not Found"
            );
            return new \Symfony\Component\HttpFoundation\Response(json_encode($status), $code, array('content-type' => 'application/json'));
            break;
    }
});
*/

//routes
$app->get('/requestfee', 'App\\Controllers\\AppController::requestFee')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/cardlink', 'App\\Controllers\\AppController::cardlink')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/validatemobilenumber', 'App\\Controllers\\AppController::validateMobileNumber')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->get('/topup', 'App\\Controllers\\AppController::topUp')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/reverse', 'App\\Controllers\\AppController::reverse')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->get('/transactioninquiry', 'App\\Controllers\\AppController::transactionInquiry')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/resetotp', 'App\\Controllers\\AppController::resetOtp')->before('App\\Middleware\\OAuthMiddleware::handle');

// oauth routes
$app->mount('/oauth', new App\Libraries\OAuth2Library());


$request = OAuth2\HttpFoundationBridge\Request::createFromGlobals();
$app->run($request);
