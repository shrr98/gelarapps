<?php

$namespace = 'Gelarapps\Common\Web\Controller';

$router->addGet('/', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'index',
    'action'   => 'index',
]);

$router->addGet('/beranda', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'index',
    'action'   => 'beranda',
]);

$router->addGet('/login', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'users',
    'action'   => 'login',
]);

$router->addGet('/signup', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'users',
    'action'   => 'signup',
]);

$router->addPost('/login', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'users',
    'action'   => 'onlogin',
]);

$router->addPost('/signup', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'users',
    'action'   => 'onsignup',
]);

$router->addGet('/logout', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'users',
    'action'   => 'logout',
]);

$router->addGet('/komunitas', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'komunitas',
    'action'   => 'index',
]);


$router->addGet('/pagelaran', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'pagelaran',
    'action'   => 'index',
]);

$router->addGet('/komunitas/list/saya/:params', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'komunitas',
    'action'    => 'list',
    'params'    => 1,
]);

$router->addGet('/pagelaran/list/:action', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'pagelaran',
    'action'   => 1,
]);

$router->addGet('/:controller/:action', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 1,
    'action'    => 2,
]);

$router->addGet('/:controller/:action/:params', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 1,
    'action'    => 2,
    'params'    => 3,
]);

$router->addPost('/komunitas/buat', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'komunitas',
    'action'    => 'onbuat',
]);

$router->addPost('/komunitas/gabung', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'komunitas',
    'action'    => 'gabung',
]);

$router->addGet('/pagelaran/buat/:params', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'pagelaran',
    'action'    => 'buat',
    'params'    => 1,
]);


$router->addPost('/pagelaran/buat/:params', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 'pagelaran',
    'action'    => 'onbuat',
    'params'    => 1,
]);


return $router;