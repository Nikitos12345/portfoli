<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 12:54
 */

namespace App\controllers;
use League\Plates\Engine;

class adminController extends AppController
{

    public function __construct(Engine $engine)
    {
        parent::__construct($engine);
    }

    public function index()
    {
        echo $this->engine->render('admin::index');
    }

}