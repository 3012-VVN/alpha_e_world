<?php

include "helper/config.php";

$email = strtoupper($_POST['username']);
$password = $_POST['password'];

$checksql = "Select * from Users where `username`='$email' and `password` = '$password'";
$checkrst = mysqli_query($con, $checksql);
$tokenrow = mysqli_fetch_assoc($checkrst);
$rowcount = mysqli_num_rows($checkrst);

if ($rowcount == 0) {
    header('Location: Login');
} else {
    if ($tokenrow['IsActive'] == 1) {
        $_SESSION['logged'] = "logged";
        $_SESSION['userid'] = $tokenrow['ID'];
        header('Location: Login');
    } else {
        $url = "?reverifyuser=user" . $tokenrow['joinkey'];
        $_SESSION['userid'] = $tokenrow['ID'];
        header('Location: VerifyUser' . $url);
    }
}