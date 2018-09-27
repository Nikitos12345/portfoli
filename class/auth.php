<?php
/* TODO Идеи для класса User
 * 1. Сделать ключ, который будет записываться в cookie вместо пароля
 * 2. Метод восстановления пароля
 * **/
class User{
    private $user;
    private $pdo;
    private $error;
    const LOGIN = "name";
    const PASSWORD = "pass";
    const EMAIL = "email";

    function __construct()
    {
        $this->pdo = new Query("users");
    }

    public function addUser($user)
    {
        if ($this->setUser($user)){
            if ($this->checkUser() == null){
                $this->PasswordHash();
                $this->pdo->Insert($this->user);
                $this->setCookie();
                $this->setSession();
                return true;
            }
            else{
                $this->error = "Name already taken";
                return false;
            }
        }
        else {
            $this->error = "Incorrect data";
            return false;
        }
    }

    public function login($user)
    {
        if ($this->setUser($user)){
            if ($this->checkUser() == true){
                $this->getUser($this->user['user_name']);
                $this->setSession();
                $this->setCookie();
                return true;
            }
        }
        return false;
    }

    public function getUser($name = null)
    {
        if (isset($name)){
            $where ['user_name'] = $name;
            $this->user = $this->pdo->Select($where);
        }
        else return $this->user;
    }

    public function getError()
    {
        echo "Error: ".$this->error;
    }

    private function setUser($user)
    {
        foreach ($user as $key => $val){
            switch ($key){
                case self::LOGIN:
                    if ($this->Verify($val, self::LOGIN)) $this->user["user_name"] = $val;
                    else return false;
                    continue;
                case self::PASSWORD:
                    $this->user["user_pass"] = $val;
                    continue;
                case self::EMAIL:
                    if ($this->Verify($val, self::EMAIL)) $this->user["user_email"] = $val;
                    else return false;
                    continue;
                default:
                    unset($user[$key]);
                    continue;
            }
        }
        return true;
    }

    private function Verify_pass($pass)
    {
        $where = ['user_name' => $this->user['user_name']];
        $result = $this->pdo->Select($where);
        if (password_verify($pass, $result['user_pass'])) return true;
        else {
            $this->error = "Incorrect password";
            return false;
        }
    }

    private function checkUser()
    {
        $where = ['user_name' => $this->user['user_name']];
        $result = $this->pdo->Select($where);
        if (empty($result)) {
            $this->error = "Incorrect login";
            return null;
        }
        else if ($this->Verify($this->user['user_pass'], self::PASSWORD)) {
            return true;
        }
        else return false;
    }

    private function Verify($val = null, $const = null){
        switch ($const){
            case self::EMAIL:
                if (filter_var($val, FILTER_VALIDATE_EMAIL)) return true;
                else {
                    $this->error = "Not valid E-mail";
                    return false;
                }
                break;
            case self::PASSWORD:
                return ($this->Verify_pass($val)) ?  true :  false;
//                $where = ['user_name' => $this->user['user_name']];
//                $result = $this->pdo->Select($where);
//                if (password_verify($val, $result['user_pass'])) return true;
//                else {
//                    $this->error = "Incorrect password";
//                    return false;
//                }
                break;
            case self::LOGIN:
                if (preg_match('/^[a-z0-9]+$/i', $val)) return true;
                else {
                    $this->error = "Not valid login";
                    return false;
                }
                break;
            default:
                if (filter_var($this->user["user_email"], FILTER_VALIDATE_EMAIL) && (preg_match('/^[a-z0-9]+$/i', $this->user['user_name']))) return true;
                else return false;
                break;
        }
    }

    private function setSession()
    {
        $_SESSION['user'] = $this->user;
        unset($_SESSION['user']['user_pass']);
    }

    private function setCookie()
    {
        setcookie("mySiteCookie", $this->user['user_name'].":", time()+(60*60));
    }

    private function PasswordHash()
    {
        $this->user["user_pass"] = password_hash($this->user["user_pass"], PASSWORD_BCRYPT);
    }

    function __destruct()
    {
        unset($this->user);
        unset($this->pdo);
    }
}