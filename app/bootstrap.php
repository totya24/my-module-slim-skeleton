<?php
session_start();

use Dopesong\Slim\Error\Whoops as WhoopsError;

require_once('vendor/autoload.php');
require_once('helpers.php');

$dotenv = new Dotenv\Dotenv(__DIR__ ."/../");
$dotenv->load();
$dotenv->required('DB_TYPE');

$dependenciesDir = __DIR__ . '/Dependencies';
$app = new IS\Slim\Tegar\App($dependenciesDir);

require_once('routes.php');

foreach(glob(__DIR__ .'/Modules/*/routes.php') as $moduleRoutes){
    include_once($moduleRoutes);
}