<?php
namespace App\controllers;
use League\Plates\Engine;
use App\models\UserModel;
use App\models\PartModel;

class siteControls
{
    private $engine;
    private $user;
    /**
     * @var PartModel
     */
    private $parts;

    function __construct(Engine $engine, UserModel $user, PartModel $parts)
    {
        $this->engine = $engine;
        $this->user = $user;
        $this->parts = $parts;
        $this->engine->addFolder('parts', '../app/views/parts');
    }

    public function index()
    {
        $parts = $this->parts->getAllParts();
        echo $this->engine->render('layout', compact("parts"));
    }

    public function register()
    {
        echo $this->engine->render('register');
    }

    public function newUser()
    {
        $id = $this->user->addUser();
        echo $this->engine->render('register', ["UserId" => $id]);
    }

    public function Login()
    {
        echo $this->engine->render('login');
    }

    public function AdminPanel($user)
    {
        if($this->user->Login($user)){
            echo $this->engine->render('admin');
        }
        else $this->user->Error();
    }

    public function Logout()
    {
        $this->user->Logout();
        header("Location: /");
    }

    public function test()
    {
        echo $this->engine->render('test');
    }
    
}