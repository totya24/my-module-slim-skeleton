<?php

return [
    'logger' => function () {
        $settings = [
            'directory' => getenv('LOG_DIR'),
            'filename' => getenv('LOG_FILE'),
            'timezone' => getenv('TIMEZONE'),
            'level' => getenv('LOG_LEVEL'),
            'handlers' => [],
        ];

    return new \Projek\Slim\Monolog('slim-app', $settings);
    }
];