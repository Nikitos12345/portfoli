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

    public function __construct()
    {
        $this->engine = new Engine("app/views");
        $this->engine->addFolder("admin", "app/views/admin");
        $this->engine->addFolder("editor", "app/views/admin/editor");
        $this->engine->addFolder("users", "app/views/admin/users");
        $this->engine->addFolder('parts', 'app/views/parts');
        $this->engine->addFolder('forms', 'app/views/forms');
//        $this->engine->addFolder('error', '../app/views/error');
    }

}