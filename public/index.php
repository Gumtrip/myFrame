<?php
require __DIR__.'/../vendor/autoload.php';


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
$request = Request::createFromGlobals();

$map = [
    '/' => 'App\Http\Controllers\IndexController',
    '/bye'   => 'bye',
];

$path = $request->getPathInfo();
if (isset($map[$path])) {
    ob_start();
    extract($request->query->all(), EXTR_SKIP);
    $controller = new $map[$path]();
    call_user_func([$controller,  ucfirst('index')]);
    $response = new Response(ob_get_clean());
} else {
    $response = new Response('Not Found', 404);
}

$response->send();