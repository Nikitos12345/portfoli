<?
//$host = 'localhost';
//$db   = 'test';
//$user = 'root';
//$pass = '';
//$charset = 'utf8';
//
//$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
//$opt = [
//    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
//    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//    PDO::ATTR_EMULATE_PREPARES   => false,
//];
//$pdo = new PDO($dsn, $user, $pass, $opt);

class Query{
    private $pdo;
    protected $table;
    function __construct($table)
    {
        $this->pdo = new PDO("mysql:host=localhost;dbname=test", "root", "", [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
        $this->table = $table;
    }
    function Select ($where = null){
        $query = "SELECT * FROM $this->table";
        if (isset($where)){
            $query .= " WHERE ".key($where)." = '".current($where)."'";
        }
        $select = $this->pdo->prepare($query);
        $select->execute();
        if (isset($where)){
            return $select->fetch();
        }
        return $select->fetchAll();
    }
    /*
     * public function Update
     * @param array $array Принимает массив значений, где ключ - имя столбца, значение - его значение
     * @param array $where Принимает значения для выборки по значению, где ключ - имя столбца
     * @return boolean или array вслучае ошибки
     * */
    function Update ($array, $where = null){
        $query = "UPDATE $this->table SET";
        foreach ($array as $key => $val) {
            $query .= " $key = :$key,";
        }
        $query = substr($query, 0, -1);
        if (isset($where)){
            $query .= " WHERE ".key($where)." = '".current($where)."'";
        }
        $update = $this->pdo->prepare("$query");
        foreach ($array as $k => $value){
            $update->bindValue(":$k", $value);
        }
        return ($update->execute()) ? true : $update->errorInfo();
    }

    /*
    * public function Insert
    * @param array $array Принимает массив значений, где ключ - имя столбца, значение - его значение
    * @return boolean или array вслучае ошибки
    * */
    function Insert($array){
        $query = "INSERT INTO $this->table SET";
        foreach ($array as $key => $val) {
            $query .= " $key = :$key,";
        }
        $query = substr($query, 0, -1);
        $insert = $this->pdo->prepare("$query");
        foreach ($array as $k => $value){
            $insert->bindValue(":$k", $value);
        }
        return ($insert->execute()) ? true : $insert->errorInfo();
    }

    function __destruct()
    {
        $this->pdo = null;
        $this->table = null;
    }
}

?>