<?
namespace App\models;

use Delight\Auth as Auth;

class UserModel{
    private $auth;
    private $massage;

    function __construct(\PDO $db)
    {

        $this->auth =  new Auth\Auth($db);
    }

    public function addUser()
    {
        try {
            $userId = $this->auth->register($_POST['email'], $_POST['password'], null);
        }
        catch (Auth\InvalidEmailException $e) {
            $this->massage = "invalid email address";
        }
        catch (Auth\InvalidPasswordException $e) {
            $this->massage = "invalid password";
        }
        catch (Auth\UserAlreadyExistsException $e) {
            $this->massage = "user already exists";
        }
        catch (Auth\TooManyRequestsException $e) {
            $this->massage = "too many requests";
        }
        return $userId;
    }


    public function Login()
    {
        try {
            $this->auth->login($_POST['email'], $_POST['password']);
        }
        catch (Auth\InvalidEmailException $e) {
            $this->massage = "wrong email address";
        }
        catch (Auth\InvalidPasswordException $e) {
            $this->massage = "wrong password";
        }
        catch (Auth\EmailNotVerifiedException $e) {
            $this->massage = "email not verified";
        }
        catch (Auth\TooManyRequestsException $e) {
            $this->massage = "too many requests";
        }
        return true;
    }

    public function Logout()
    {
        $this->auth->logOut();
    }

    public function Error()
    {
        return $this->massage;
    }
}