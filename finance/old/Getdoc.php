<?php 

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$email1=$_REQUEST['uid'];

$checksql= "SELECT * FROM `kycdetails` JOIN Users on Users.ID= kycdetails.userid WHERE `Users`.`ID`='$email1'";

$checkrst = mysqli_query($con, $checksql);
$inviteuser = mysqli_fetch_assoc($checkrst);

echo "<img src='".$inviteuser['insertValuesSQL']."'>";