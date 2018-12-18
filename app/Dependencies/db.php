<?php
return [
    'db' => function (Interop\Container\ContainerInterface $c) {
        $type = getenv('DB_TYPE');

        if($type != 'none'){
            $database = new \Medoo\Medoo([
                'database_type' => $type,
                'database_name' => getenv('DB_NAME'),
                'server' => getenv('DB_HOST'),
                'username' => getenv('DB_USER'),
                'password' => getenv('DB_PASS'),
                'charset' => getenv('CHARSET')
            ]);
        }

        return $database;
    }
];