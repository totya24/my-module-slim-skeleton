<?php

return [
    \Slim\Views\Twig::class => function (Interop\Container\ContainerInterface $c) {
        $modulePaths = ['templates'];
        foreach(glob(__DIR__ .'/../Modules/*', GLOB_ONLYDIR) as $module){
            $moduleName = basename($module);
            $modulePaths[$moduleName] = $module."/Templates/";
        }

        $twig = new \Slim\Views\Twig($modulePaths, [
            'debug' => false,
            'charset' => getenv('CHARSET'),
            'cache' => getenv('TWIG_CACHEDIR'),
            'auto_reload' => true,
        ]);
        $twig->addExtension(
            new \Slim\Views\TwigExtension(
                    $c->get('router'), 
                    $c->get('request')->getUri()
            )
        );
        return $twig;
    }
];