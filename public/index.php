<?php
require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel;
use Symfony\Component\Routing;

$request = Request::createFromGlobals();
$requestStack = new RequestStack();
$routes = include __DIR__.'/../routes/index.php';


$context = new Routing\RequestContext();
$context->fromRequest($request);
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$dispatcher = new EventDispatcher();
//addListener()关联了一个指向了“命名事件”（response）的有效PHP回调。事件名称必须和使用在dispatch()方法中的那个一样,位置在 Framework 43行
//$dispatcher->addListener('response', array(new Simplex\ContentLengthListener(), 'onResponse'), -255);
//$dispatcher->addListener('response', array(new Simplex\GoogleListener(), 'onResponse'));
$dispatcher->addSubscriber(new HttpKernel\EventListener\RouterListener($matcher, $requestStack));

$errorHandler = function (Symfony\Component\ErrorHandler\Exception\FlattenException $exception) {
    $msg = 'Something went wrong! ('.$exception->getMessage().')';

    return new Response($msg, $exception->getStatusCode());
};
$dispatcher->addSubscriber(new HttpKernel\EventListener\ErrorListener($errorHandler));
$dispatcher->addSubscriber(new HttpKernel\EventListener\ResponseListener('UTF-8'));
$dispatcher->addSubscriber(new HttpKernel\EventListener\StreamedResponseListener());
$dispatcher->addSubscriber(new Simplex\StringResponseListener());

$framework = new Simplex\Framework($dispatcher, $controllerResolver,$requestStack, $argumentResolver);


$response = $framework->handle($request);
$response->send();
