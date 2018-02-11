<?php

/** Environments */
$environments = array(
    'development' => '.oo',
    'production' => '.production',
);

foreach($environments as $key => $env){
    if(strstr($_SERVER['SERVER_NAME'], $env) !== false){
        define('ENVIRONMENT', $key);
        break;
    }
}

if(!defined('ENVIRONMENT')) define('ENVIRONMENT', 'development');

switch(ENVIRONMENT){
    case 'development':
        $displayErrors = true;
        $dbHost = '';
        $dbUser = '';
        $dbName = '';
        $dbPass = '';
        break;
    case 'production':
        $displayErrors = false;
        $dbHost = 'localhost';
        $dbUser = '';
        $dbName = '';
        $dbPass = '';
        break;
}

return [
    'settings' => [
        'displayErrorDetails' => $displayErrors,
    ],
	'database' => [
		'database_type' => 'mysql',
		'database_name' => $dbName,
		'server' => $dbHost,
		'username' => $dbUser,
		'password' => $dbPass,
		'charset' => 'utf8'
	],
	'assets' => [
        'baseDir' => '/assets/',
		'js' => [
			'header' => [
				'main' => 'js/script.min.js'
			],
			'footer' => [
			]
		],
		'css' => [
			'main' => 'css/style.min.css'
		]
    ]
];