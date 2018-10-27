<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 11:38
 */

namespace App\controllers;
use App\models\authModel;

class authController extends AppController
{
    /**
     * @var authModel
     */
    private $user;

    public function __construct( authModel $user)
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
        if (isset($_POST['login'])){
            $this->user->Login();
        }
        if ($this->user->AuthCheck()){
            echo $this->engine->render('admin::index');
        }
        else {
            echo $this->engine->render('forms::login');
        }

    }

    public function resetPassword()
    {
        if (!$this->user->AuthCheck()) {
            if (isset($_POST['resetPassword'])) {
                if ($this->user->initPasswordReset()) {
                    echo $this->engine->render('forms::successForm');
                } else {
                    echo $this->engine->render('forms::resetPassword');
                }
            } else echo $this->engine->render("forms::resetPassword");
        }
        else header('Location:/admin');
    }

    public function VerifyTokenForReset($selector, $token)
    {
        if (!$this->user->AuthCheck()) {
            $this->user->VerifyTokenForReset($selector, $token);
            echo $this->engine->render('forms::resetPasswordForm', compact('selector', 'token'));
        } else header('Location:/admin');
    }

    public function updatePassword()
    {
        if (!$this->user->AuthCheck()) {
            if ($this->user->updatePassword()){
                echo $this->engine->render('forms::successForm');
            } else {
                echo $this->engine->render('forms::resetPasswordForm', compact('selector', 'token'));
            }
        } else header('Location:/admin');
    }

    public function Logout()
    {
        $this->user->Logout();
        header("Location: /");
    }
}