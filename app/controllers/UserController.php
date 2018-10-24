<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 11:38
 */

namespace App\controllers;
use App\models\UserModel;

class UserController extends AppController
{
    /**
     * @var UserModel
     */
    private $user;

    public function __construct( UserModel $user)
    {
        parent::__construct();
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
        else {
            echo $this->engine->render('forms::login');
        }

    }

    public function resetPassword()
    {
        if (isset($_POST['resetPassword'])){
           if($this->user->initPasswordReset()){
               header('Location:/');
           } else {
               $error = $this->user->Error();
               echo $this->engine->render('forms::resetPassword', compact('error'));
           }
        }else echo $this->engine->render("forms::resetPassword");
    }

    public function VerifyTokenForReset($selector, $token)
    {
        if ($this->user->VerifyTokenForReset($selector, $token)){
            echo $this->engine->render('forms::resetPasswordForm', compact('selector', 'token'));
        }
        else {
            $error = $this->user->Error();
            echo $this->engine->render('errors', compact('error'));
        }
    }

    public function updatePassword()
    {
        if ($this->user->updatePassword()){
            header('Location:/admin');
        } else {
            $error = $this->user->Error();
            echo $this->engine->render('forms::resetPasswordForm', compact('error'));
        }
    }

    public function Login()
    {
        if($this->user->Login()){
            header('Location:/admin');
        }
        else {
            $error = $this->user->Error();
            echo $this->engine->render('forms::login', compact('error'));
        }
    }

    public function Logout()
    {
        $this->user->Logout();
        header("Location: /");
    }
}