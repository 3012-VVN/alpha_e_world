<?php 

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$checksql= "SELECT * FROM `LevelBonus` WHERE `userid`='$email' and `Date`='".$_REQUEST['date']."'  ORDER BY `levelno` ASC";
echo "----- Dated ".$_REQUEST['date']." -----------<br>";
$checkrst = mysqli_query($con, $checksql);
while($inviteuser = mysqli_fetch_assoc($checkrst)){
    if ($inviteuser['levelno']==4)
    {
        echo "Level: 1 Balance Amount: ".$inviteuser['Level']."<br>";
    }else{
        echo "Level: ".$inviteuser['levelno']." Amount: ".$inviteuser['Level']."<br>";
    }
}