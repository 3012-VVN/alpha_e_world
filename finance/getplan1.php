<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

if (isset($_REQUEST['plan']) && isset($_REQUEST['qty'])) {

    $checksql1 = "SELECT * FROM `topup` where `step`<4 and userid='$email'";
    $checkrst1 = mysqli_query($con, $checksql1);
    $rowcount1 = mysqli_num_rows($checkrst1);
    $UserBankInfo1 = mysqli_fetch_assoc($checkrst1);

    $amount = intval($_REQUEST['qty']);
    if ($rowcount1 == 0) {

        $sql = "INSERT INTO `topup` (`ID`, `userid`, `amount`, `step`, `adate`, `sdate`, `date`) VALUES (NULL, '$email', '$amount', '1', now(), '1',now());";
        mysqli_query($con, $sql);
        header('Location: TopUp');
    } else {
        $id= $UserBankInfo1['ID'];
        $checksql = "UPDATE `topup` SET `step`='1',`amount` = '" . intval($_REQUEST['qty']) . "' WHERE `ID`='$id'";
        $checkrst = mysqli_query($con, $checksql);
        header('Location: TopUp');
    }

    /* if (intval($_REQUEST['plan']) >0 && intval($_REQUEST['qty']) >0) {
$checksql = "UPDATE `Users` SET `step`='1',`qty` = '".intval($_REQUEST['qty'])."',`plan` = '".intval($_REQUEST['plan'])."' WHERE `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
header('Location: Dashboard');
}else {
header('Location: Dashboard');
}*/
} else {
    header('Location: TopUp');
}
