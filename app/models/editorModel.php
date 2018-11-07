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
        $temp = $this->query->getOne('templates', ['id' => $id]);
        $temp['display'] = ($temp['display']) ? 'true' : 'false';
        $temp['options'] = $this->getOption($temp['options']);
        $temp['content'] = $this->getTempContent($id);
        return $temp;
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

    private function getOption($option){
        preg_match_all('/\\w+/', $option, $options, PREG_PATTERN_ORDER);
        return $options[0];
    }

    public function updateTemp($id)
    {
       $data = $this->getDataForUpdate();
       foreach ($data as $key => $a){
           $this->query->updateOne('content',[ $key => $a], ['temp_id' => $id]);
       }

    }

    private function getDataForUpdate()
    {
        unset($_POST['_wysihtml5_mode']);
        $data = array();
        $options = $this->getOption($_POST['options']);
        foreach ($_POST as $key => $item){
            foreach ($options as $option) {
                if ($key == $option){
                    if (preg_match('/head[0-9]/', $key) && !empty($item)){
                        $data['header'] .= $key.'<'.htmlspecialchars($item).">";
                    }
                    if (preg_match('/text[0-9]/', $key) && !empty($item)){
                        $data['text'] .= $key.'<'.htmlspecialchars($item).">";
                    }
                    if (preg_match('/btn[0-9]/', $key) && !empty($item)){
                        $data['btn'] .= $key.'<'.htmlspecialchars($item).">";
                    }
                }
            }
        }
        return $data;
    }

    public function updateTemplatesOrder()
    {
        preg_match_all('/[a-z-]+/i',$_POST['order'], $orders);
        foreach ($orders[0] as $key => $item){
            $this->query->updateOne('templates', ['turn' => $key], ['name' => $item] );
        }
    }

}