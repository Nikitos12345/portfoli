<?
include "connect.php";
$query = new Query("users");
session_start();
if ($_POST['register']){
    $users = $query->Select();
    foreach ($users as $user){
        if ($user['user_name'] == $_POST['name']){
            $_SESSION['error'] = "Такой пользователь уже существует";
            header("Location:index.php");
        }
        if ($_POST['email'] == $user['email'] ){
            $_SESSION['error'] = "Пользователь с такой почтой уже существует";
            header("Location:index.php");
        }
    }

    $hash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
    $new_user = array("user_name" => $_POST['name'],"user_pass" => $hash, "user_email" => $_POST['email']);
    if (is_array($query->Insert($new_user))){
        var_dump($query->Insert($new_user));
    }
    else {
        setcookie('TestCookie', $_POST['name'].".".$hash, time()+(60*60));
        $_SESSION['id'] = $_COOKIE['PHPSESSID'];
        $_SESSION['name'] = $_POST['name'];
        unset($_SESSION['error']);
        unset($hash, $new_user, $users);
        header("Location:index.php");
    }
}

if ($_POST['log_in']){
    $users = $query->Select();
    foreach ($users as $user){
        if ($user['user_name'] == $_POST['name']){
            if (password_verify($_POST['pass'], $user['user_pass'])){
                setcookie('TestCookie', $_POST['name'].".".$user['user_pass'], time()+(60*60));
                $_SESSION['id'] = $_COOKIE['PHPSESSID'];
                $_SESSION['name'] = $_POST['name'];
                unset($hash, $new_hash, $where,$user,$key, $users);
                unset($_SESSION['error']);
                header("Location:index.php");
            }
            else {
                $_SESSION['error'] = "Неверный пароль";
                header("Location:index.php");
            }
        }
        else  $_SESSION['error'] = "Неверный логин";
    }
    header("Location:index.php");
}

if ($_POST['delete']){
    session_unset();
    session_destroy();
    setcookie('TestCookie', " ", time()-(60*60));
    header("Location:index.php");
}
if ($_POST['reset']){
    $users = $query->Select();
    foreach ($users as $user){
        if ($_POST['email'] == $user['user_email'] ) break;
        else unset($user);
    }
    unset($users);
    if (isset($user)){
        $key = array("skey"=> substr(bin2hex(random_bytes(10)), 0, 10));
        $where = array("user_id" => $user['user_id']);
        if (is_array($query->Update($key, $where))){
            var_dump($query->Update($key, $where));
        }
        else{
//            mail($_POST['email'], 'Смена пароля', "<a href='http://".$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']."?key={$key['skey']}'>Пароль</a>");
//            header("Location:index.php");
            header("Location:form.php?key={$key['skey']}");
        }
    }
    else {
        $_SESSION['error'] = "Пользователь с такой почтой не существует";
        header("Location:index.php");
    }
}

if (isset($_GET['key'])){
    $where = array("skey" => $_GET['key']);
    $user = $query->Select($where, 2);
    if ($user){
        ?>
            <form action="form.php" method="post">
                <input type="password" name="new_pass" placeholder="Введите новый пароль">
                <input type="password" name="double_pass" placeholder="Повторите новый пароль">
                <input type="hidden" name="key" value="<?=$_GET['key'] ?>">
                <input type="submit" name="update_pass">
            </form>
        <?
    }
    else {
        $_SESSION['error'] = "Неверная ссылка";
        header("Location:index.php");
    }

}
if ($_POST['update_pass']){
    if ($_POST['new_pass'] == $_POST['double_pass']){
        $new = array('user_pass' =>  password_hash($_POST['new_pass'], PASSWORD_BCRYPT), 'skey' => null);
        $where = array("skey" => $_POST['key']);
        if (is_array($query->Update($new, $where))){
            var_dump($query->Update($new, $where));
        }
        else {
            unset($_SESSION['error']);
            header("Location:index.php");
        }
    }
    else{
        $_SESSION['error'] = "Пароли не совпадают";
        header("Location:index.php");
    }
}

