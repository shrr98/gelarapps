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


$router->addGet('/:controller/:action/:params', [
    'namespace' => $namespace,
    'module'    => 'common',
    'controller'=> 1,
    'action'    => 2,
    'params'    => 3,
]);


return $router;