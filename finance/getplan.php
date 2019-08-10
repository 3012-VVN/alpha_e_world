<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

if (isset($_REQUEST['plan']) && isset($_REQUEST['qty'])) {
    if (intval($_REQUEST['plan']) > 0 && intval($_REQUEST['qty']) > 0) {
        echo $checksql = "UPDATE `Users` SET `step`='1',`qty` = '" . intval($_REQUEST['qty']) . "',`plan` = '" . intval($_REQUEST['plan']) . "' WHERE `ID`='$email'";
        $checkrst = mysqli_query($con, $checksql);
    }
}
header('Location: Dashboard');
