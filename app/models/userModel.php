<?php
/**
 * Created by PhpStorm.
 * User: Nikita
 * Date: 21.10.2018
 * Time: 20:34
 */

namespace App\models;


class userModel
{
    private $auth;
    /**
     * @var QueryModel
     */
    private $query;

    public static $massage = null;

    public static $error = null;

    public function __construct(\PDO $PDO, QueryModel $query)
    {
        $sessionResyncInterval = 0;
        $this->auth = new \Delight\Auth\Auth($PDO, $sessionResyncInterval);
        $this->query = $query;
    }

    public function addUser()
    {
        try {
           $this->auth->admin()->createUserWithUniqueUsername($_POST['email'], $_POST['password'], $_POST['username']);
            self::$massage = 'User has create';
            return true;
        }
        catch (\Delight\Auth\InvalidEmailException $e) {
            self::$error = 'Invalid email address';
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            self::$error = 'Invalid password';
        }
        catch (\Delight\Auth\UserAlreadyExistsException $e) {
            self::$error = 'User already exists';
        }
        catch (\Delight\Auth\DuplicateUsernameException $e) {
            self::$error = 'Need unique Username';
        }
        return false;
    }

    public function deleteUser($id)
    {
        try {
            $this->auth->admin()->deleteUserById($id);
            self::$massage = 'User was been delete';
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            self::$error = 'Unknown ID';
        }
    }

    public function getAllUses()
    {
        $cols = ['id', 'email', 'username', 'verified', 'registered', 'last_login'];
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

    public function addAdminRoles($id)
    {
        try {
            $this->auth->admin()->addRoleForUserById($id, \Delight\Auth\Role::ADMIN);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            self::$error = 'Unknown user ID';
        }
    }

    public function addVisitorRoles($id)
    {
        try {
            $this->auth->admin()->addRoleForUserById($id, \Delight\Auth\Role::REVIEWER);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            self::$error = 'Unknown user ID';
        }
    }

    public function getUser($id)
    {
        self::$error = 'this\'s show page';
        $cols = ['id', 'email', 'verified', 'roles_mask', 'registered','last_login'];
        $user = $this->query->getOne('users', ['id' => $id], $cols);
        $user = $this->reworkUserData($user);
        $usercol = [
            'id' => 'User id',
            'email' => 'E-mail',
            'verified' => 'Verified',
            'roles_mask' => 'Roles',
            'registered' => 'Register Date',
            'last_login' => 'Last Login'
        ];
        foreach ($user as $key => $item){
            foreach ($usercol as $col => $val){
                if($key == $col){
                    $newUser[$val] = $item;
                }
            }
        }
        return $newUser;
    }

    private function reworkUserData($user)
    {
        $user['verified'] = ($user['verified']) ? 'verified' : 'not verified';
        $user['roles_mask'] = $this->checkRoles($user['id']);
        $user['registered'] = date('H:i j/M/y',$user['registered']);
        $user['last_login'] = date('H:i j/M/y', $user['last_login']);
        $user['enable'] = $this->getPasswordEnable($user['id']);
        return $user;
    }

    public function updateUserPassword($id)
    {
        try {
            $this->auth->admin()->changePasswordForUserById($id, $_POST['newPassword']);
            self::$massage = 'User password was been update';
            return true;
        }
        catch (\Delight\Auth\UnknownIdException $e) {
            self::$error = 'Unknown ID';
        }
        catch (\Delight\Auth\InvalidPasswordException $e) {
            self::$error = 'Invalid password';
        }
        return false;
    }

    public function checkRoles($userId)
    {
        $role =  $this->auth->admin()->getRolesForUserById($userId);
        return current($role);
    }

    public function removeRoles($userId)
    {
        try {
            $this->auth->admin()->removeRoleForUserById($userId, \Delight\Auth\Role::ADMIN);
            $this->auth->admin()->removeRoleForUserById($userId, \Delight\Auth\Role::REVIEWER);
        }
        catch (\Delight\Auth\UnknownIdException $e) {
           self::$error = 'Unknown user ID';
        }
    }

    public function AuthCheck()
    {
        return $this->auth->isLoggedIn();
    }

    public function setPasswordEnable($id, $value)
    {
        $this->query->updateOne('users', ['resettable' => $value], ['id' => $id]);
    }

    public function getPasswordEnable($id)
    {
        $enable = $this->query->getOne('users', ['id' => $id], ['resettable']);
        return current($enable);
    }

    public function isAdmin()
    {
        return $this->auth->hasRole(\Delight\Auth\Role::ADMIN);
    }

    public static function getError()
    {
        return self::$error;
    }

    public static function getMassage()
    {
        return self::$massage;
    }



}