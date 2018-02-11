<?php

//$app->add(new \App\Modules\Test\Middlewares\TestMiddleware());

$app->get('/test', \App\Modules\Test\Controllers\TestController::class . '@test');