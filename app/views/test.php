<?php $this->layout('layout') ;

echo "<div style='text-align:left;'>";
use Aura\SqlQuery\QueryFactory;
use App\models\QueryModel;

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

$query = $container->get("App\\models\\QueryModel");
$array = [
    "page_name" => "hero",
    "turn" => 2
];
var_dump($query->getAll('pages'));


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