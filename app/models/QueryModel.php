<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 16.10.2018
 * Time: 13:57
 */

namespace App\models;
use Aura\SqlQuery\QueryFactory;

class QueryModel
{
    /**
     * @var QueryFactory
     */
    private $db;
    /**
     * @var QueryFactory
     */
    private $queryFactory;

    function __construct(QueryFactory $queryFactory, \PDO $db)
    {
        $this->db = $db;
        $this->queryFactory = $queryFactory;
    }

    public function getAll($table)
    {
        $select = $this->queryFactory->newSelect();
        $select->cols(['*']);
        $select->from($table);
        $sth = $this->db->prepare($select->getStatement());
        $sth->execute($select->getBindValues());
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function addOne($table, $value)
    {
        $insert = $this->queryFactory->newInsert();
        $insert
            ->into($table)
            ->cols(array_keys($value))
            ->bindValues($value);
        $sth = $this->db->prepare($insert->getStatement());
        $sth->execute($insert->getBindValues());
    }

}