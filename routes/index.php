<?php

use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('IndexController', new Routing\Route('/', [
    'name' => 'jack',
    '_controller' =>'App\Http\Controllers\IndexController::index',
]));
$routes->add('FooController', new Routing\Route('/foo/{name}', [
    'name' => 'tom',
    '_controller' => 'App\Http\Controllers\FooController::index',
]));
return $routes;
