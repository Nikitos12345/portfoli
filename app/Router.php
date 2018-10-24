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
        $r->addRoute('GET', '/', ['App\controllers\AdminController', "index"]);
        $r->addRoute(['GET', 'POST'],'/users', ['App\controllers\AdminController', "showALlUsers"]);
        $r->get('/users/delete/{id}', ['App\controllers\AdminController', "deleteUser"]);
        $r->get('/users/show/{id}', ['App\controllers\AdminController', "showUser"]);
//        $r->post('/users/adduser', ['App\controllers\AdminController', "addUser"]);
        $r->post('/users/update/{id}', ['App\controllers\AdminController', "updateUser"]);

    });
    $r->get('/admin', ['App\controllers\UserController', "AuthCheck"]);
    $r->post("/login", ['App\controllers\UserController', "Login"]);
    $r->addRoute(['GET', 'POST'], '/reset-password', ['App\controllers\UserController', "resetPassword"]);
    $r->get('/verify-email/{selector}/{token}', ['App\controllers\UserController', "VerifyTokenForReset"]);
    $r->get('/show/layout/{layout}/{group}', ['App\controllers\siteControls', "showLayout"]);
    $r->post('/update-password', ['App\controllers\UserController', "updatePassword"]);
    $r->addRoute('GET', '/test', ['App\controllers\siteControls', "test"]);
    $r->addRoute('GET', '/logout', ['App\controllers\UserController', "Logout"]);
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