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

    public function showAllUsers()
    {
        $this->checkAuth();
        $isAdmin = $this->admin->isAdmin();
        if ($_POST['addUser']){
            $this->admin->addUser();
        }
        $users = $this->admin->getAllUses();
        echo $this->engine->render('admin::users', compact('users', 'isAdmin'));
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
        echo $this->engine->render('admin::user', compact('user', 'isAdmin'));
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