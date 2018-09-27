<?php
class Redirect
{
    public static function Redirect($name)
    {
        header("Location:".$name);
    }
}