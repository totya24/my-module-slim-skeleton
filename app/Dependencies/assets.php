<?php

return [
	'assets' => [
        'baseDir' => getenv('ASSETS_DIR'),
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