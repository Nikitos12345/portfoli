<?php
/**
 * Created by PhpStorm.
 * User: Никита
 * Date: 16.10.2018
 * Time: 12:28
 */

namespace App\models;
use League\Plates\Engine;

class PartModel
{
    /**
     * @var Engine
     */
    private $engine;

    /**
     * @var QueryModel
     */
    private $query;

    function __construct(Engine $engine, QueryModel $query)
    {
        $this->engine = $engine;
        $this->query = $query;
    }

    public function getAllParts()
    {
        $parts = $this->dbAllParts();
        $newParts = array();
        foreach ($parts as $part){
            $newParts[$part['id']] = $part['page_name'];
        }
        ksort($newParts);
        return $newParts;
    }

    private function dbAllParts(){
        return $this->query->getAll("templates");
    }


    public function getContent()
    {
        $newContent = array();
        $content = $this->query->getAll('content', ['temp_id','header', 'text', 'images']);
        foreach ($content as $array){
            $newContent[$array['temp_id']] = $array;
            unset($newContent[$array['temp_id']]['temp_id']);
        }
        return $newContent;

}
}