<?php
use League\Plates\Engine;
use Aura\SqlQuery\QueryFactory;

$builder = new \DI\ContainerBuilder();
$builder->addDefinitions([
    PDO::class => function(){
        return new \PDO("mysql:host=localhost;dbname=test", 'root', '', [PDO::FETCH_ASSOC]);
    },
    Engine::class => function(){
        return new Engine("app/views");
    },
    QueryFactory::class => function(){
        return new QueryFactory("mysql");
    }
]);
$container = $builder->build();

require "Router.php";