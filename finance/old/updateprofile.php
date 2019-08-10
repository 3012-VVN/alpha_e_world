<?php

include "helper/header.php";
include "helper/config.php";

$email =  $_SESSION['userid'];

$required = array();
foreach ($_POST as $key => $value)
{
    $required[]=$key;
}
$error = false;
foreach($required as $field) {
  if (trim($_REQUEST[$field])=='') {
    echo "empty";
    $error = true;
  }
}
if (!$error) {
    $checksql = "UPDATE `Users` SET `firstname` = '".$_REQUEST['firstname']."', `middlename` = '".$_REQUEST['middlename']."', `lastname` = '".$_REQUEST['lastname']."', `email` = '".$_REQUEST['email']."', `mobile` = '".$_REQUEST['mobile']."', `country` = '".$_REQUEST['country']."', `city` = '".$_REQUEST['city']."', `pincode` = '".$_REQUEST['pincode']."', `address` = '".$_REQUEST['address']."', `aboutme` = '".$_REQUEST['aboutme']."' WHERE `Users`.`ID` = '$email'";
    $checkrst = mysqli_query($con, $checksql);
    $tokenrow = mysqli_fetch_assoc($checkrst);
    $rowcount = mysqli_num_rows($checkrst);
}


header('Location: UserInfo');
