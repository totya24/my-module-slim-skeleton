<?php
return [
    'db' => function (Interop\Container\ContainerInterface $c) {
        $config = $c->get('database');

        $database = new \Medoo\Medoo([
            'database_type' => $config['database_type'],
            'database_name' => $config['database_name'],
            'server' => $config['server'],
            'username' => $config['username'],
            'password' => $config['password']
        ]);

        return $database;
    }
];