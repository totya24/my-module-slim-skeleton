<?php

use Whoops\Handler\Handler;
use Dopesong\Slim\Error\Whoops as WhoopsError;

$errorHandler = function ($c) {
    $logger = $c->get('logger');
    $showError = getenv('SHOW_ERRORS');
    $whoopsHandler = new WhoopsError($showError);

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