<?php
require_once __DIR__.'/../vendor/autoload.php';

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

//register error handler
$app->error(function(\Exception $e, $code) {
    $status = null;
    switch ($code) {
        case 500:
            $status = array(
                "status"        => "fail",
                "timestamp"     => date('Y-m-d H:i:s'),
                "p2me_result"   => "Internal Server Error"
            );
            return new \Symfony\Component\HttpFoundation\Response(json_encode($status), $code);
            break;
        case 404:
            $status = array(
                "status"        => "fail",
                "timestamp"     => date('Y-m-d H:i:s'),
                "p2me_result"   => "Resource Not Found"
            );
            return new \Symfony\Component\HttpFoundation\Response(json_encode($status), $code);
            break;
    }
});

//routes
$app->get('/hello', 'App\\Controllers\\HelloController::hello')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->get('/users', 'App\\Controllers\\HelloController::get')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/requestfee', 'App\\Controllers\\RequestFeeController::requestFee')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/cardlink', 'App\\Controllers\\CardLinkController::cardlink')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/validatemobilenumber', 'App\\Controllers\\ValidateMobileNumberController::validateMobileNumber')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/topup', 'App\\Controllers\\TopUpController::topUp')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/reverse', 'App\\Controllers\\ReverseController::reverse')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/transactioninquiry', 'App\\Controllers\\TransactionInquiryController::transactionInquiry')->before('App\\Middleware\\OAuthMiddleware::handle');
$app->post('/resetotp', 'App\\Controllers\\ResetOtpController::resetOtp')->before('App\\Middleware\\OAuthMiddleware::handle');

// oauth routes
$app->mount('/oauth', new App\Libraries\OAuth2Library());


$request = OAuth2\HttpFoundationBridge\Request::createFromGlobals();
$app->run($request);
