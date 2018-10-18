<?php
namespace App\controllers;
use League\Plates\Engine;
use App\models\UserModel;
use App\models\PartModel;

class siteControls extends AppController
{
    private $user;
    /**
     * @var PartModel
     */
    private $parts;

    function __construct(Engine $engine, UserModel $user, PartModel $parts)
    {
        parent::__construct($engine);
        $this->user = $user;
        $this->parts = $parts;


    }

    public function index()
    {
        $parts = $this->parts->getAllParts();
        echo $this->engine->render('layout', compact("parts"));
    }

    public function admin()
    {
        echo $this->engine->render('login');
    }

    public function test()
    {
        echo $this->engine->render('test');
    }
    
}