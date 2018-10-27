<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 11:59
 */

use FastRoute\RouteCollector;

$dispatcher = FastRoute\simpleDispatcher(function(RouteCollector $r) {
    $r->addRoute('GET', '/', ['App\controllers\siteControls', "index"]);
    $r->addGroup('/admin', function (RouteCollector $r) {
        $r->get('/', ['App\controllers\AdminController', "index"]);
        $r->addGroup('/users', function (RouteCollector $r) {
            $r->get('/', ['App\controllers\AdminController', "showAllUsers"]);
            $r->get('/delete/{id}', ['App\controllers\AdminController', "deleteUser"]);
            $r->get('/show/{id}', ['App\controllers\AdminController', "showUser"]);
            $r->post('/', ['App\controllers\AdminController', "addUser"]);
            $r->post('/update/{id}', ['App\controllers\AdminController', "updateUser"]);
        });
        $r->addGroup('/edit', function (RouteCollector $r){
            $r->get('/', ['App\controllers\AdminController', "updateUser"]);
        });

    });
    $r->addRoute(['GET', 'POST'], '/admin', ['App\controllers\authController', "AuthCheck"]);
    $r->addRoute(['GET', 'POST'], '/reset-password', ['App\controllers\authController', "resetPassword"]);
    $r->get('/verify-email/{selector}/{token}', ['App\controllers\authController', "VerifyTokenForReset"]);
    $r->post('/update-password', ['App\controllers\authController', "updatePassword"]);
    $r->get('/show/layout/{layout}/{group}', ['App\controllers\siteControls', "showLayout"]);
    $r->addRoute('GET', '/test', ['App\controllers\siteControls', "test"]);
    $r->addRoute('GET', '/logout', ['App\controllers\authController', "Logout"]);
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
        echo 'error 404';
//        $temp = $container->get("League\Plates\Engine");
//        echo $temp->render('NotFound');
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        var_dump($_SERVER);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}