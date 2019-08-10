<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$required = array();
foreach ($_POST as $key => $value) {
    $required[] = $key;
    echo $key;
}
$error = false;
foreach ($required as $field) {
    if (trim($_REQUEST[$field]) == '') {
        echo "empty";
        $error = true;
    }
}
$imagetype = array(image_type_to_mime_type(IMAGETYPE_GIF), image_type_to_mime_type(IMAGETYPE_JPEG),
    image_type_to_mime_type(IMAGETYPE_PNG), image_type_to_mime_type(IMAGETYPE_BMP));
if (!$error) {
    $checksql = "SELECT * FROM `kycdetails` where userid='$email'";
    $checkrst1 = mysqli_query($con, $checksql);
    $rowcount1 = mysqli_num_rows($checkrst1);

    //var_dump($_FILES['files']);

    //if (!empty(array_filter($_FILES['files']['name']))) {
    //var_dump($_FILES['files']);
    $targetDir = "../assets/kyc/";
    $insertValuesSQL = "";

    foreach ($_FILES['files']['name'] as $key => $val) {
        // File upload path
        //if (in_array($_FILES["files"]["type"][$key], $imagetype)) {
            $fileName = basename($_FILES['files']['name'][$key]);
            $file_extention = @strtolower(@end(@explode(".", $fileName)));
            // Setting an unique name for the file
            $file_name = date("Ymd") . '_' . rand(10000, 990000) . '.' . $file_extention;
            $targetFilePath = $targetDir . $file_name;

            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowTypes=array('jpg','png','jpeg');
            if (in_array($fileType, $allowTypes)) {
                // Upload file to server
                if (move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)) {
                    // Image db insert sql
                    //$insertValuesSQL .= "('" . $fileName . "', NOW()),";
                    $insertValuesSQL .= $targetFilePath;
                } else {
                    $errorUpload .= $_FILES['files']['name'][$key] . ', ';
                }
            } else {
                $errorUploadType .= $_FILES['files']['name'][$key] . ', ';
            }
        //}
        //}
    }

    if ($rowcount1 > 0) {
        echo $update = "UPDATE `kycdetails` SET `cardtype`='" . mysqli_real_escape_string($con, $_REQUEST['cardtype']) . "',`pancard`='" . mysqli_real_escape_string($con, $_REQUEST['pancard']) . "',`adharcard`='" . mysqli_real_escape_string($con, $_REQUEST['adharcard']) . "', `bankname`='" . mysqli_real_escape_string($con, $_REQUEST['bankname']) . "', `accno`='" . mysqli_real_escape_string($con, $_REQUEST['accno']) . "', `ifsccode`='" . mysqli_real_escape_string($con, $_REQUEST['ifsccode']) . "',`swiftcode`= '" . mysqli_real_escape_string($con, $_REQUEST['swiftcode']) . "',`insertValuesSQL`='$insertValuesSQL',`status`=0 where `userid`='$email'";
        mysqli_query($con, $update);
    } else {
        echo $insrt = "INSERT INTO `kycdetails` (`ID`, `userid`, `pancard`, `adharcard`, `bankname`, `accno`,`accname`, `ifsccode`,`swiftcode`,`cardtype`,`insertValuesSQL`,`status`) VALUES (NULL, '" . $email . "', '" . mysqli_real_escape_string($con, $_REQUEST['pancard']) . "', '" . mysqli_real_escape_string($con, $_REQUEST['adharcard']) . "', '" . mysqli_real_escape_string($con, $_REQUEST['bankname']) . "', '" . mysqli_real_escape_string($con, $_REQUEST['accno']) . "', '" . mysqli_real_escape_string($con, $_REQUEST['accname']) . "', '" . mysqli_real_escape_string($con, $_REQUEST['ifsccode']) . "','" . mysqli_real_escape_string($con, $_REQUEST['swiftcode']) . "','" . mysqli_real_escape_string($con, $_REQUEST['cardtype']) . "','$insertValuesSQL',0);";
        mysqli_query($con, $insrt);
    }
}

header('Location: UserInfo#Bank');
