<?php
return [
    'notFoundHandler' => function ($c) {
        return function ($request, $response) use ($c) {
            $twig = $c->get(\Slim\Views\Twig::class);
            return $twig->render($response->withStatus(404), 'pages/404.twig', []);
        };
    }
];