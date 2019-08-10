<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

if (isset($_REQUEST['tdate']) && isset($_REQUEST['tdetails'])) {

    $tdate = $_REQUEST['tdate'];
    $tdetails = $_REQUEST['tdetails'];

    if (trim($tdate) != "" && trim($tdetails) != '') {
        echo $insert = "INSERT INTO `userpayment` (`ID`, `userid`, `recipt`, `tranferdetails`, `transferdate`,`planid`,`verified`) VALUES (NULL, '$email', '', '$tdetails', '$tdate',0,0);";

        mysqli_query($con, $insert);

        $checksql = "UPDATE `Users` SET `step`='2'  WHERE `ID`='$email'";
        $checkrst = mysqli_query($con, $checksql);
    } else {
        
        $imageFileType = strtolower(pathinfo($_FILES["recipt"]["name"], PATHINFO_EXTENSION));
        if (strlen($imageFileType)>=3) {
            $fname = uniqid();
            $tosave = '../allrecipt/' . $fname . "." . $imageFileType;
            move_uploaded_file($_FILES["recipt"]["tmp_name"], $tosave);

            echo $insert = "INSERT INTO `userpayment` (`ID`, `userid`, `recipt`, `tranferdetails`, `transferdate`,`planid`,`verified`) VALUES (NULL, '$email', '$tosave', '', '',0,0);";
            mysqli_query($con, $insert);

            $checksql = "UPDATE `Users` SET `step`='2'  WHERE `ID`='$email'";
            $checkrst = mysqli_query($con, $checksql);
        }
    }

    header('Location: Dashboard');
}
