<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 11:38
 */

namespace App\controllers;
use App\models\UserModel;
use League\Plates\Engine;

class UserController extends AppController
{
    /**
     * @var UserModel
     */
    private $user;

    public function __construct(Engine $engine, UserModel $user)
    {
        parent::__construct($engine);
        $this->user = $user;
    }

    public function newUser()
    {
        $id = $this->user->addUser();
        echo $this->engine->render('register', ["UserId" => $id]);
    }

    public function AuthCheck()
    {
        if ($this->user->AuthCheck()){
            echo $this->engine->render('admin::index');
        }
        else echo $this->engine->render('admin::login');

    }

    public function Login()
    {
        if($this->user->Login()){
            header('Location:/admin');
        }
        else {
            $error = $this->user->Error();
            echo $this->engine->render('error', compact('error'));
        }
    }

    public function Logout()
    {
        $this->user->Logout();
        header("Location: /");
    }
}