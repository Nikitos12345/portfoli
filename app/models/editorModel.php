<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 27.10.2018
 * Time: 13:46
 */

namespace App\models;


class editorModel
{
    /**
     * @var QueryModel
     */
    private $query;

    public function __construct(QueryModel $query)
    {
        $this->query = $query;
    }

    public function getAllTemp()
    {
        $temps = $this->query->getAll('templates');
        foreach ($temps as &$temp){
            $temp['display'] = ($temp['display']) ? 'true' : 'false';
        }
        return $temps;
    }

    public function getOneTemp($id)
    {
        return $this->query->getOne('templates', ['id' => $id]);
    }

    private function getOption($id){
        $options = array();
        $strOption = $this->query->getOne('templates', ['id' => $id],['options']);
        preg_match_all('/\\w+/', $strOption['options'], $options);
        return $options[0];
    }
    

}