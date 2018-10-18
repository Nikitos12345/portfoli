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
            $newParts[$part['turn']] = $part['page_name'];
        }
        ksort($newParts);
        return $newParts;
    }

    private function getDirParts()
    {
        $parts = $this->RenameFile(scandir($_SERVER['DOCUMENT_ROOT'].'/../app/views/parts'));
        return $parts;
    }

    private function dbAllParts(){
        return $this->query->getAll("pages");
    }

    private function dbAddParts()
    {
        $partsFolder = $this->getDirParts();
        $partsDb = $this->dbAllParts();
        static $i = 0;
        foreach ($partsFolder as $key => $part){
            foreach ($partsDb as $arr){
                if ($part == $arr['page_name']){
                    unset($partsFolder[$key]);
                    $i++;
                    break;
                }
            }
        }
        unset($part);
        if (!empty($partsFolder)){
            foreach ($partsFolder as $part){
                $this->query->addOne("pages", ['page_name' => $part, 'turn' => $i]);
                $i++;
            }
        }
    }

    private function RenameFile($array)
    {
        foreach ($array as $key => &$item){
            if (preg_match('/(\\w+).php/i', $item)){
                $item = preg_replace('/(\\w+).php/i', '$1', $item);
            } else unset($array[$key]);
        }
        return $array;
    }
}