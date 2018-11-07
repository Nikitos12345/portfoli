<?php
echo "<h1>This is test page</h1>";

echo "<div style='text-align:left;'>";
use Aura\SqlQuery\QueryFactory;

$builder = new \DI\ContainerBuilder();


$builder->addDefinitions([
    PDO::class => function(){
        return new \PDO("mysql:host=localhost;dbname=test", 'root', '', [PDO::FETCH_ASSOC]);
    },
    QueryFactory::class => function(){
        return new QueryFactory("mysql");
    }
]);

$container = $builder->build();

//class Query
//{
//    /**
//     * @var PDO
//     */
//    private $db;
//
//    function __construct(\PDO $db)
//    {
//
//        $this->db = $db;
//    }
//
//    public static function newClass()
//    {
//        return "Query";
//    }
//
//    public function Select()
//    {
//        $select = $this->db->query("SELECT * FROM users");
//        return $select->fetchAll();
//    }
//}
//
//$QueryManager = $container->get('Query');
//
//var_dump($QueryManager);

echo "</div>";