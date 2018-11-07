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
            $newParts[$part['turn']] = array(
                'name' => $part['name'],
                'content' => $this->getTempContent($part['id'])
            );
        }
        ksort($newParts);
        return $newParts;
    }

    private function dbAllParts(){
        return $this->query->getAll("templates");
    }

    private function getTempContent($id){
        $content = $this->query->getOne('content', ['temp_id' => $id]);
        $newContent = array();
        if (!empty($content['header'])){
            preg_match_all('/(head[0-9])<(.*)>/U', $content['header'], $header);
        }
        if ($content['text']){
            preg_match_all('/(text[0-9])<(.*)>/Us', $content['text'], $text);
        }
        if ($content['btn']){
            preg_match_all('/(btn[0-9])<(.*)>/Us', $content['btn'], $btn);
        }
        for ($i = 0; $i < count($header[1]); $i++){
            $newContent[$header[1][$i]] = htmlspecialchars_decode($header[2][$i]);
        }
        for ($i = 0; $i < count($text[1]); $i++){
            $newContent[$text[1][$i]] = htmlspecialchars_decode($text[2][$i]);
        }
        for ($i = 0; $i < count($btn[1]); $i++){
            $newContent[$btn[1][$i]] = htmlspecialchars_decode($btn[2][$i]);
        }
        return $newContent;
    }

}