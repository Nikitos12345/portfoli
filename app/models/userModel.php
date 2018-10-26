<?
namespace App\models;

use Delight\Auth as Auth;

class UserModel{
    private $auth;
    public static $error;
    public static $massage;

    function __construct(\PDO $db)
    {

        $this->auth =  new Auth\Auth($db);
    }

    public function addUser()
    {
        try {
            $userId = $this->auth->register($_POST['email'], $_POST['password'], null);
            return $userId;
        }
        catch (Auth\InvalidEmailException $e) {
            self::$error = "invalid email address";
        }
        catch (Auth\InvalidPasswordException $e) {
            self::$error = "invalid password";
        }
        catch (Auth\UserAlreadyExistsException $e) {
            self::$error = "user already exists";
        }
        catch (Auth\TooManyRequestsException $e) {
            self::$error = "too many requests";
        }
        return false;
    }

    public function Login()
    {
        if ($_POST['remember'] == 1) {
            // keep logged in for one year
            $rememberDuration = (int) (60 * 5);
        }
        else {
            // do not keep logged in after session ends
            $rememberDuration = null;
        }
        try {
            $this->auth->login($_POST['email'], $_POST['password'], $rememberDuration);
            return true;
        }
        catch (Auth\InvalidEmailException $e) {
            self::$error = "wrong email address";
        }
        catch (Auth\InvalidPasswordException $e) {
            self::$error = "wrong password";
        }
        catch (Auth\EmailNotVerifiedException $e) {
            self::$error = "email not verified";
        }
        catch (Auth\TooManyRequestsException $e) {
            self::$error = "too many requests";
        }
        catch (Auth\EmailOrUsernameRequiredError $e){
            self::$error = "Ошибка, повторите авторизацию";
        }
        return false;
    }

    public function initPasswordReset()
    {
        try {
            $this->auth->forgotPassword($_POST['email'], function ($selector, $token) {
                $subject = 'Reset Password';
                $url = 'http://site/verify-email/' . \urlencode($selector) . '/' . \urlencode($token);
                $message = "<p>Reset you password on <a href='$url'>link</a></p>";
                mail($_POST['email'], $subject, $message);
                self::$massage = 'A letter with a link sent to your email';
                return true;
            });
        }
        catch (Auth\InvalidEmailException $e) {
            self::$error = 'Invalid email address';
        }
        catch (Auth\EmailNotVerifiedException $e) {
            self::$error = 'Email not verified';
        }
        catch (Auth\ResetDisabledException $e) {
            self::$error = 'Password reset is disabled. Contact your administrator.';
        }
        catch (Auth\TooManyRequestsException $e) {
            self::$error = 'Too many requests';
        }
        return false;
    }

    public function VerifyTokenForReset($selector, $token)
    {
        try {
            $this->auth->canResetPasswordOrThrow($selector, $token);
            return true;
        }
        catch (Auth\InvalidSelectorTokenPairException $e) {
            self::$error = 'Invalid token';
        }
        catch (Auth\TokenExpiredException $e) {
            self::$error = 'Token expired';
        }
        catch (Auth\ResetDisabledException $e) {
            self::$error = 'Password reset is disabled';
        }
        catch (Auth\TooManyRequestsException $e) {
            self::$error = 'Too many requests';
        }
        return false;
    }

    public function updatePassword(){
        try {
            $this->auth->resetPassword($_POST['selector'], $_POST['token'], $_POST['password']);

            return true;
        }
        catch (Auth\InvalidSelectorTokenPairException $e) {
            self::$error = 'Invalid token';
        }
        catch (Auth\TokenExpiredException $e) {
            self::$error = 'Token expired';
        }
        catch (Auth\ResetDisabledException $e) {
            self::$error = 'Password reset is disabled';
        }
        catch (Auth\InvalidPasswordException $e) {
            self::$error = 'Invalid password';
        }
        catch (Auth\TooManyRequestsException $e) {
            self::$error = 'Too many requests';
        }
        return false;
    }

    public function AuthCheck()
    {
        return $this->auth->isLoggedIn();
    }

    public function Logout()
    {
        $this->auth->logOut();
    }


}