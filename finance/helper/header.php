<?php
include "check.php";

session_start();

function findinURL($filename)
{
    $url = $_SERVER['REQUEST_URI'];
    $arr = explode($filename, $url);
    $bool = 0;
    if (count($arr) == 2) {$bool = 1;}
    return $bool;
}

if (isset($_SESSION['logged']) && $_SESSION['logged'] == 'logged') {
    if (findinURL('Login') == 1 || findinURL('Registration') == 1) {
        header('Location: /Dashboard');
    }
} else {
    if (findinURL('Login') == 0 && findinURL('Registration') == 0 && findinURL('VerifyUser') == 0 && findinURL('ResetPassword') == 0) {
        header('Location: Login');
        //echo "redirect";
    }
}
$_title = "Alpha Exchange World";