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
        $r->addRoute(['GET', 'POST'], '', ['App\controllers\authController', "AuthCheck"]);
        $r->addGroup('/users', function (RouteCollector $r) {
            $r->get('', ['App\controllers\userController', "showAllUsers"]);
            $r->get('/delete/{id}', ['App\controllers\userController', "deleteUser"]);
            $r->get('/show/{id}', ['App\controllers\userController', "showUser"]);
            $r->post('', ['App\controllers\userController', "addUser"]);
            $r->post('/update/{id}', ['App\controllers\userController', "updateUser"]);
        });
        $r->addGroup('/editor', function (RouteCollector $r){
            $r->get('', ['App\controllers\editorController', "getAllTemp"]);
            $r->addRoute('GET', '/edit/{id}', ['App\controllers\editorController', "editTemplate"]);
            $r->post('/update/{id}', ['App\controllers\editorController', "updateTemplate"]);
            $r->post('/update-parts', ['App\controllers\editorController', "updateTemplatesOrder"]);
        });

    });
    $r->addRoute(['GET', 'POST'], '/reset-password', ['App\controllers\authController', "resetPassword"]);
    $r->get('/verify-email/{selector}/{token}', ['App\controllers\authController', "VerifyTokenForReset"]);
    $r->post('/update-password', ['App\controllers\authController', "updatePassword"]);
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
        $temp = $container->get("League\Plates\Engine");
        echo $temp->render('NotFound', ['page' => 404]);
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        $temp = $container->get("League\Plates\Engine");
        echo $temp->render('NotFound', ['page' => 405]);
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}