<?php

include "helper/header.php";
include "helper/config.php";

session_start();

$attempt = intval($_SESSION['attempt']);
if ($_SESSION['otp'] ==  $_REQUEST['otp'] && $attempt<4)
{
    $_SESSION['logged']= "logged";
    $_SESSION['userid']= $_SESSION['userid1'] ;
    header('Location: Login');
}else {
    $attempt++;
    $_SESSION['attempt']=  $attempt;
    header('Location: VerifyUser?otp=failed');
}