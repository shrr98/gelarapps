<?php

use Phalcon\Mvc\View;

$di['view'] = function () {
    $view = new View();
    $view->setViewsDir(__DIR__ . '/../Web/Views/');

    $view->registerEngines(
        [
            ".volt" => "voltService",
        ]
        );

    return $view;
};
