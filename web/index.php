<?php
require_once __DIR__.'/../vendor/autoload.php';
//require_once __DIR__.'/../app/config/database.php';

$app = new Silex\Application();
$app->boot();
$app['debug'] = true;

//initialize dotenv
$app['env'] = new Dotenv\Dotenv(__DIR__.'/../');
$app['env']->load();

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
    'monolog.logfile' => __DIR__.'/../logs/log-'.date('Y-m-d').'.txt'
));

//register security service provider
$app->register(new Silex\Provider\SecurityServiceProvider());

//register validator provider (optional)
$app->register(new Silex\Provider\ValidatorServiceProvider());


//routes
$app->get('/hello', 'App\\Controllers\\HelloController::hello')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->get('/users', 'App\\Controllers\\HelloController::get')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/requestfee', 'App\\Controllers\\RequestFeeController::requestFee')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/cardlink', 'App\\Controllers\\CardLinkController::cardlink')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->mount('/oauth', new App\Libraries\OAuth2Library());


$request = OAuth2\HttpFoundationBridge\Request::createFromGlobals();
$app->run($request);
