<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$checksql1 = "SELECT * FROM `topup` where `step`<4 and userid='$email'";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);
$UserBankInfo1 = mysqli_fetch_assoc($checkrst1);

if ($rowcount1==1) {
    $step = intval($UserBankInfo1['step']);
    if ($step==1) {
        $id= $UserBankInfo1['ID'];
        $checksql = "UPDATE `topup` SET `step`='0'  WHERE `ID`='$id'";
        $checkrst = mysqli_query($con, $checksql);
    }
}
