<?php

include "helper/header.php";
include "helper/config.php";

$email = $_REQUEST['uid'];

$checksql = "SELECT * FROM `kycdetailsapproval` where `userid`='$email' and `status`=0";
$checkrst = mysqli_query($con, $checksql);
$tokenrow = mysqli_fetch_assoc($checkrst);
$rowcount = mysqli_num_rows($checkrst);

$checksql = "SELECT * FROM `kycdetails` where userid='$email'";
$checkrst1 = mysqli_query($con, $checksql);
$rowcount1 = mysqli_num_rows($checkrst1);
$bool = $_REQUEST['bool'];
if ($bool == 1) {

    if ($rowcount1 > 0) {
        $update = "UPDATE `kycdetails` SET `pancard`='" . $tokenrow['pancard'] . "',`adharcard`='" . $tokenrow['adharcard'] . "', `bankname`='" . $tokenrow['bankname'] . "', `accno`='" . $tokenrow['accno'] ."', `ifsccode`='" . $tokenrow['ifsccode'] ."' where `userid`='$email'";
        mysqli_query($con, $update);
    } else {
        $insrt = "INSERT INTO `kycdetails` (`ID`, `userid`, `pancard`, `adharcard`, `bankname`, `accno`, `ifsccode`) VALUES (NULL, '" . $tokenrow['userid'] . "', '" . $tokenrow['pancard'] . "', '" . $tokenrow['adharcard'] . "', '" . $tokenrow['bankname'] . "', '" . $tokenrow['accno'] . "', '" . $tokenrow['ifsccode'] . "');";
        mysqli_query($con, $insrt);
    }

    $update = "UPDATE kycdetailsapproval SET status=1 where `userid`='$email' and `status`=0";
    $checkrst = mysqli_query($con, $update);
    echo "Approved Account Changes";
} else {
    $update = "UPDATE kycdetailsapproval SET status=2 where `userid`='$email' and `status`=0";
    $checkrst = mysqli_query($con, $update);

    echo " Account Changes Rejected";
}


