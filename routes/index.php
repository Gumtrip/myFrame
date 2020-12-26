<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('IndexController', new Routing\Route('/'));
$routes->add('FooController', new Routing\Route('/foo/{name}',['name' => 'Foo']));

return $routes;