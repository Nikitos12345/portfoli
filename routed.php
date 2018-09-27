<?php
switch ($_SERVER['REQUEST_URI']){
    case "/profile":
        include_once "pages/profile.php";
        break;
    case "/check_in":
        include "pages/register.php";
        break;
    case "/auth":
        include "pages/authorization.php";
        break;
    case "/upload_img":
        include "class/upload.php";
        break;
}