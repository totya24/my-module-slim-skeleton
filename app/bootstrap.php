<?php
session_start();

require_once('vendor/autoload.php');

use Dopesong\Slim\Error\Whoops as WhoopsError;

$configDir = __DIR__ . '/Config';
$app = new IS\Slim\Tegar\App($configDir);

require_once('routes.php');

foreach(glob(__DIR__ .'/Modules/*/routes.php') as $moduleRoutes){
    include_once($moduleRoutes);
}