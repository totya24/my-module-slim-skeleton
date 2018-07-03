<?php
session_start();

require_once('vendor/autoload.php');

use Dopesong\Slim\Error\Whoops as WhoopsError;

$dotenv = new Dotenv\Dotenv(__DIR__ ."/../");
$dotenv->load();
$dotenv->required('DB_TYPE');

$depedenciesDir = __DIR__ . '/Depedencies';
$app = new IS\Slim\Tegar\App($depedenciesDir);

require_once('routes.php');

foreach(glob(__DIR__ .'/Modules/*/routes.php') as $moduleRoutes){
    include_once($moduleRoutes);
}