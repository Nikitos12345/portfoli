<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 12:54
 */

namespace App\controllers;
use App\models\userModel;

class userController extends AppController
{

    /**
     * @var userModel
     */
    private $admin;

    public function __construct(userModel $admin)
    {
        parent::__construct();
        $this->admin = $admin;
    }

    public function showAllUsers()
    {
        $this->checkAuth();
        $isAdmin = $this->admin->isAdmin();
        $users = $this->admin->getAllUses();
        echo $this->engine->render('users::users', compact('users', 'isAdmin'));
    }

    public function addUser()
    {
        $this->checkAuth();
        $this->admin->addUser();
        $users = $this->admin->getAllUses();
        echo $this->engine->render('users::users', compact('users', 'isAdmin'));
    }

    public function deleteUser($id)
    {
        $this->checkAuth();
        if ($this->admin->isAdmin()){
            $this->admin->deleteUser($id);
        }
        header('Location:/admin/users');
    }

    public function showUser($id)
    {
        $this->checkAuth();
        $isAdmin = $this->admin->isAdmin();
        $user = $this->admin->getUser($id);
        echo $this->engine->render('users::user', compact('user', 'isAdmin'));
    }

    public function updateUser($id)
    {
        $this->checkAuth();
        if ($this->admin->isAdmin()) {
            if (isset($_POST)){
                if (isset($_POST['enable'])) {
                    $this->admin->setPasswordEnable($id, $_POST['enable']);
                }
                switch ($_POST['rotes']) {
                    case 'ADMIN':
                        $this->admin->removeRoles($id);
                        $this->admin->addAdminRoles($id);
                        break;
                    case 'REVIEWER':
                        $this->admin->removeRoles($id);
                        $this->admin->addVisitorRoles($id);
                        break;
                }
                if (isset($_POST['newPassword'])) {
                    $this->admin->updateUserPassword($id);
                }
            }
        }
        header('Location:/admin/users');
    }

    private function checkAuth()
    {
        if (!$this->admin->AuthCheck()){
            header("Location:/admin");
        }
    }

}