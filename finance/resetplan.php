<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];


$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$step = intval($UserInfo['step']);

if ($step==1) {
    $checksql = "UPDATE `Users` SET `step`='0'  WHERE `ID`='$email'";
    $checkrst = mysqli_query($con, $checksql);
}
