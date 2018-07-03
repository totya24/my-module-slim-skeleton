<?php

return [
    'flash' => function () {
        $settings = [
			'directory' => 'storage/logs',
			'filename' => 'app.log',
			'timezone' => 'Europe/Budapest',
			'level' => 'debug',
			'handlers' => [],
		];

    return new \Projek\Slim\Monolog('slim-app', $settings);
    }
];