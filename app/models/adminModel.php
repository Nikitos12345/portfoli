<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 21.10.2018
 * Time: 20:34
 */

namespace App\models;


class adminModel
{
    private $authManager;
    private $error;
    /**
     * @var QueryModel
     */
    private $query;

    public function __construct(\PDO $PDO, QueryModel $query)
    {
        $sessionResyncInterval = 0;
        $this->authManager = new \Delight\Auth\Auth($PDO, $sessionResyncInterval);
        $this->query = $query;
    }

    public function addUser()
    {
        try {
           $this->authManager->admin()->createUser($_POST['email'], $_POST['password']);
            $this->error = 'User has create';
            return true;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            $this->error = 'Invalid email address';
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->error = 'Invalid password';
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            $this->error = 'User already exists';
        }
        return false;
    }

    public function deleteUser($id)
    {
        try {
            $this->authManager->admin()->deleteUserById($id);
            return true;
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            $this->error = 'Unknown ID';
        }
        return false;
    }

    public function getAllUses()
    {
        $cols = ['id', 'email', 'verified', 'registered', 'last_login'];
        $users = $this->query->getAll('users', $cols);
        foreach ($users as &$user){
            foreach ($user as $key => &$userdata) {
                if ($key == 'registered' || $key == 'last_login'){
                    $userdata = empty($userdata) ? ' ': date('H:i j/M/y', $userdata);
                }
                if ($key == 'verified'){
                    $userdata = $userdata == 1? 'true' : 'false';
                }
            }
        }
        return $users;
    }

    public function getError()
    {
        return $this->error;
    }

    public function addAdminRoles($id)
    {
        try {
            $this->authManager->admin()->addRoleForUserById($id, \Delight\Auth\Role::ADMIN);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            $this->error = 'Unknown user ID';
        }
    }

    public function addVisitorRoles($id)
    {
        try {
            $this->authManager->admin()->addRoleForUserById($id, \Delight\Auth\Role::REVIEWER);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            $this->error = 'Unknown user ID';
        }
    }

    public function showUser($id)
    {
        $cols = ['id', 'email', 'verified', 'roles_mask', 'registered','last_login'];
        $user = $this->query->getOne('users', ['id' => $id], $cols);
        $user['verified'] = ($user['verified']) ? 'verified' : 'not verified';
        $user['roles_mask'] = $this->checkRoles($user['id']);
        $user['registered'] = date('H:i j/M/y',$user['registered']);
        $user['last_login'] = date('H:i j/M/y', $user['last_login']);
        return $user;
    }

    public function updateUserPassword($id)
    {
        try {
            $this->authManager->admin()->changePasswordForUserById($id, $_POST['newPassword']);
            return true;
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            $this->error = 'Unknown ID';
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            $this->error = 'Invalid password';
        }
        return false;
    }

    public function checkRoles($userId)
    {
        $role =  $this->authManager->admin()->getRolesForUserById($userId);
        return current($role);
    }

    public function removeRoles($userId)
    {
        try {
            $this->authManager->admin()->removeRoleForUserById($userId, \Delight\Auth\Role::ADMIN);
            $this->authManager->admin()->removeRoleForUserById($userId, \Delight\Auth\Role::REVIEWER);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
           $this->error = 'Unknown user ID';
        }
    }

}