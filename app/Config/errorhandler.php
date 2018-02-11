<?php

$errorHandler = function($c) {
	return new Dopesong\Slim\Error\Whoops($c->get('settings')['displayErrorDetails']);
};

return [
	'phpErrorHandler' => $errorHandler,
	'errorHandler' => $errorHandler
];