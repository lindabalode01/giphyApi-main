<?php

require_once 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/searchedGiphys', 'app\Controller\GiphyController@searchedGiphys');
    $r->addRoute('GET', '/trendingGiphy', 'app\Controller\GiphyController@trendingGiphy');
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];

        [$controllerName, $methodName] = explode('@', $handler);
        $controllerName = new $controllerName;

        $collection = $controllerName->{$methodName}();
        break;
}
$loader = new \Twig\Loader\FilesystemLoader(__DIR__.'app/Views');
$twig = new \Twig\Environment($loader);
echo $twig->render('giffs.php', [
    'collection' => $gifCollection,
    'formSubmission'=> $_GET['formSub'],
    'keyWord'  => $_GET['keyWord']

]);
