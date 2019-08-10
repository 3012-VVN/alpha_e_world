<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];
echo "In";
if (isset($_REQUEST['tdate']) && isset($_REQUEST['tdetails'])) {

    echo $tdate = $_REQUEST['tdate'];
    echo $tdetails = $_REQUEST['tdetails'];

    echo $checksql1 = "SELECT * FROM `topup` where `step`=1 and userid='$email'";
    $checkrst1 = mysqli_query($con, $checksql1);
    echo $rowcount1 = mysqli_num_rows($checkrst1);
    $UserBankInfo1 = mysqli_fetch_assoc($checkrst1);

    //$amount = intval($_REQUEST['qty']);
    if ($rowcount1 == 1) {
        //echo "In";
        $id = $UserBankInfo1['ID'];

        if (trim($tdate) != "" && trim($tdetails) != '') {
            echo $insert = "INSERT INTO `userpayment` (`ID`, `userid`, `recipt`, `tranferdetails`, `transferdate`,`planid`,`verified`) VALUES (NULL, '$email', '', '$tdetails', '$tdate','$id',0);";

            mysqli_query($con, $insert);

            $checksql = "UPDATE `topup` SET `step`='2'  WHERE `ID`='$id'";
            $checkrst = mysqli_query($con, $checksql);
        } else {
            $imageFileType = strtolower(pathinfo($_FILES["recipt"]["name"], PATHINFO_EXTENSION));
            if (strlen($imageFileType) >= 3) {
                $fname = uniqid();
                $tosave = '../allrecipt/' . $fname . "." . $imageFileType;
                move_uploaded_file($_FILES["recipt"]["tmp_name"], $tosave);

                echo $insert = "INSERT INTO `userpayment` (`ID`, `userid`, `recipt`, `tranferdetails`, `transferdate`,`planid`,`verified`) VALUES (NULL, '$email', '$tosave', '', '','$id',0);";
                mysqli_query($con, $insert);

                $checksql = "UPDATE `topup` SET `step`='2'  WHERE `ID`='$id'";
                $checkrst = mysqli_query($con, $checksql);
            }
        }

        header('Location: TopUp');
    } else {

    }
}