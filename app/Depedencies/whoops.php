<?php

use Whoops\Handler\Handler;
use Dopesong\Slim\Error\Whoops as WhoopsError;

$errorHandler = function ($c) {
    $logger = $c->get('logger');
    $whoopsHandler = new WhoopsError();

    $whoopsHandler->pushHandler(
        function ($exception) use ($logger) {
            $logger->error($exception->getMessage(), ['exception' => $exception]);
            return Handler::DONE;
        }
    );

    return $whoopsHandler;
};

return [
	'phpErrorHandler' => $errorHandler,
	'errorHandler' => $errorHandler
];