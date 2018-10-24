<?php
namespace App\controllers;

use App\models\PartModel;

class siteControls extends AppController
{
    /**
     * @var PartModel
     */
    private $parts;

    function __construct(PartModel $parts)
    {
        parent::__construct();
        $this->parts = $parts;


    }

    public function index($massage = null)
    {
        $parts = $this->parts->getAllParts();

        echo $this->engine->render('layout', compact("parts", 'massage'));
    }

    public function NotFound()
    {
        echo $this->engine->render('error::n');
    }

    public function test()
    {
        echo $this->engine->render('test');
    }

    public function showLayout($layout, $group = null)
    {
        if(isset($group)){
            $group .= '::';
            echo $this->engine->render($group.$layout);
        } else echo $this->engine->render($layout);
    }
    
}