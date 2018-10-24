<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 18.10.2018
 * Time: 12:54
 */

namespace App\controllers;
use App\models\adminModel;

class adminController extends AppController
{

    /**
     * @var adminModel
     */
    private $admin;

    public function __construct(adminModel $admin)
    {
        parent::__construct();
        $this->admin = $admin;
    }

    public function index()
    {
        $this->checkAuth();
        echo $this->engine->render('admin::index');
    }

    public function showAllUsers()
    {
        $this->checkAuth();
        if ($_POST['addUser']){
            if($this->admin->addUser()){
                $massage = $this->admin->getError();
                $name = 'massage';
            }
            else {
                $error = $this->admin->getError();
                $name = 'error';
            }
        }
        $users = $this->admin->getAllUses();
        echo $this->engine->render('admin::users', compact('users', "$name"));
    }

    public function deleteUser($id)
    {
        $this->checkAuth();
        $this->admin->deleteUser($id);
        header('Location:/admin/users');
    }

    public function addUser()
    {
        $this->checkAuth();
        if($this->admin->addUser()){
            header('Location:/admin/users');
        } else {}
    }

    public function showUser($id)
    {
        $this->checkAuth();
        $user = $this->admin->showUser($id);
        $userColumn = $this->admin->getUserColumnName(array_keys($user));
        echo $this->engine->render('admin::user', compact('user', 'userColumn'));
    }

    public function updateUser($id)
    {
        $this->checkAuth();
        $this->admin->removeRoles($id);
        switch ($_POST['rotes']){
            case 'ADMIN':
                $this->admin->addAdminRoles($id);
                break;
            case 'REVIEWER':
                $this->admin->addVisitorRoles($id);
                break;
        }
        if (isset($_POST['newPassword'])){
            $this->admin->updateUserPassword($id);
        }
        header('Location:/admin/users');
    }

    public function checkAuth()
    {
        if (!$this->admin->AuthCheck()){
            header("Location:/admin");
        }
    }

}