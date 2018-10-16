<?php
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function(){
        return new \PDO("mysql:host=localhost;dbname=test", 'root', '', [PDO::FETCH_ASSOC]);
    },
    Engine::class => function(){
        return new Engine("../app/views");
    },
    QueryFactory::class => function(){
        return new QueryFactory("mysql");
    }
]);
$container = $builder->build();

$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/register', ['App\controllers\siteControls', "register"]);
    $r->addRoute('POST', '/newuser', ['App\controllers\siteControls', "newUser"]);
    $r->addRoute('GET', '/', ['App\controllers\siteControls', "index"]);
    $r->addRoute('GET', '/admin', ['App\controllers\siteControls', "Login"]);
    $r->addRoute('GET', '/test', ['App\controllers\siteControls', "test"]);
//    $r->addRoute('POST', '/', ['App\models\UserModel', "addUser"]);
   // $r->addRoute('POST', '/login', ['App\controllers\siteControls', "AdminPanel"]);
    $r->addRoute('GET', '/logout', ['App\controllers\siteControls', "Logout"]);
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
        echo "404 Not Found";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo '405 Method Not Allowed';
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $container->call($handler, $vars);
        break;
}