<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 13:41
 */

namespace App\controllers;
use League\Plates\Engine;

abstract class AppController
{
    /**
     * @var Engine
     */
    protected $engine;

    public function __construct(Engine $engine)
    {

        $this->engine = $engine;
        $this->engine->addFolder("admin", "../app/views/admin");
        $this->engine->addFolder('parts', '../app/views/parts');
    }

}