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

    public function index()
    {
        $parts = $this->parts->getAllParts();
        echo $this->engine->render('layout', compact("parts"));
    }

    
}