<?php

require '../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Register the monolog logging service
$app->register(new Silex\Provider\MonologServiceProvider(), array(
  'monolog.logfile' => 'php://stderr',
));

// Register the Twig templating engine
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/../views',
));

// Our web handlers

$app->get('/', function () use ($app) {
  $app['monolog']->addDebug('logging output.');

    return $app['twig']->render('index.twig');
});

//front ui
$app->get('/front/', function () use ($app) {
    return $app['twig']->render('index.twig');
});

//echo tone
$app->get('/echo/{tone}', function ($tone) use ($app) {
    return $app['twig']->render('echo_tone.twig', array(
        'tone' => $tone,
    ));

});

//
$app->get('/regist/{tone}', function ($tone) use ($app) {
    $_con = getDBConnection();
    $sqlresult = pg_query_params(
        $_con,
        'INSERT INTO tones (tone) VALUES($1) returning id;',
        array($tone)
    );
    $arr = pg_fetch_all_columns($sqlresult, 0);
    pg_close($_con);

    return $app['twig']->render('regist.twig', array(
        'id' => $arr[0],
        'tone' => $tone,
    ));

});

//delete all tones in table
$app->get('/delete/', function () use ($app) {
    $_con = getDBConnection();
    $sqlresult = pg_query($_con, 'DELETE FROM tones');
    pg_close($_con);

        return $app['twig']->render('echo_tone.twig', array(
        'tone' => 'all tone deleted',
    ));
});

//get tone list
$app->get('/get/tonelist/', function () use ($app) {

    $result;
    $_con = getDBConnection();
    $sqlresult = pg_query($_con, 'SELECT id,tone FROM tones ORDER BY created desc');
    if (!$sqlresult) {
        echo "An error occurred.\n";
        exit;
    }
    $arr = pg_fetch_all_columns($sqlresult, 1);

    pg_close($_con);

    return $app['twig']->render('echo_tone.twig', array(
        'tone' => implode(',', $arr),
    ));
});

//get tone list as json
$app->get('/get/tonelist/json/', function () use ($app) {

    $result;
    $_con = getDBConnection();
    $sqlresult = pg_query($_con, 'SELECT id,tone FROM tones ORDER BY created desc');
    //$sqlresult = pg_query($_con, "SELECT array_to_json( array_agg(tones)) FROM tones");
    if (!$sqlresult) {
        echo "An error occurred.\n";
        exit;
    }
    $arr = pg_fetch_all($sqlresult);
    pg_close($_con);

    return $app->json($arr, 200);
});

$app->run();

function getDBConnection()
{
    $dbUrl = parse_url(getenv('DATABASE_URL'));
    $dbName = ltrim($dbUrl['path'], '/');
    $dbHost = $dbUrl['host'];
    $dbPort = $dbUrl['port'];
    $dbUser = $dbUrl['user'];
    $dbPass = $dbUrl['pass'];

    $conn = 'host='.$dbHost.' dbname='.$dbName.' user='.$dbUser.' password='.$dbPass;

    return pg_connect($conn);
}
