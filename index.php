<?php
session_start();

require_once "class/query.php";
require_once "class/auth.php";
require_once "class/upload.php";
require_once "routed.php";
$user = new User;
if ($_POST['register']){
    if ($user->addUser($_POST) != false){
        echo "ok";
    } else $user->getError();
}
if ($_POST['log_in']){
    if ($user->login($_POST)){
        header("Location: http://{$_SERVER['HTTP_HOST']}/profile");
    } else $user->getError();
}
require "header.php";
$select = new Query("users");
var_dump($select->Select(["user_id"=>83]));
//if (isset($_COOKIE['TestCookie'])){
//    $value = 0;
//    preg_match_all("/(.*)\\.(.*)/",$_COOKIE['TestCookie'], $value);
//    include "class/query.php";
//    $query = new Query("users");
//    $users = $query->Select_where(array("column" => "user_name","value" => $value[1][0]));
//    if (!empty($users) && $users['user_pass'] == $value[1][1]){
//        $_SESSION["id"] = $_COOKIE['PHPSESSID'];
//        $_SESSION['name'] =  $value[1][0];
//    }
//}
//
//if (!isset($_SESSION['id'])) {
//    echo $_SESSION['error'];
//    include "body.html";
//}
//else {
//        echo "Hello $_SESSION[name]";
//        ?>
<!--        <form action="form.php" method="post">-->
<!--            <input type="submit" name="delete" value="Выход" >-->
<!--        </form>-->
<!---->
<!--        --><?//
//    }
//?>
<!--<hr>-->
<!--    <form action="form.php" method="post">-->
<!--        <input type="email" name="email">-->
<!--        <input type="submit" name="reset" value="Восстановить">-->
<!--    </form>-->
<?//
//echo "<hr>";
require "footer.php";
