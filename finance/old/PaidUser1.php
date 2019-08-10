<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$quote = [
    "Finance is not merely about making money. It's about achieving our deep goals and protecting the fruits of our labor. It's about stewardship and, therefore, about achieving the good society.",
    "A budget tells us what we can't afford, but it doesn't keep us from buying it.",
    "Beware of little expenses. A small leak will sink a great ship.",
];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan < 3 || $email != 1) {
    header('Location: Login');
}

$d = date('d');
$m = date('m');
$y = date('Y');

$d = date('d');
$m = date('m');
$y = date('Y');
if ($d > 1 && $d <= 15) {
    $mm = $m - 1;
    if ($mm < 1) {
        $mm = 12;
        $y--;
    }
    $date = $y . "-" . ($m - 1) . "-31";
} else {
    $date = $y . "-" . $m . "-16";
}
$ttstamp = strtotime($date);

$uid = $_REQUEST['uid'];


$totalamount = 0;

$sql = "SELECT sum(amount) as ttt FROM `payourplan` where `userid` = '$uid' and `date`<'$ttstamp' and `status` = 0";
$checkrst2 = mysqli_query($con, $sql);
$row2 = mysqli_fetch_assoc($checkrst2);
$totalamount += (intval($row2['ttt']));

$sql = "SELECT sum(Level) as LevelS,Sum(Bonus) as BonusS FROM `LevelBonus` where `userid` = '$uid' and `sdate`<'$ttstamp' and `status`=0";
$checkrst3 = mysqli_query($con, $sql);
$row3 = mysqli_fetch_assoc($checkrst3);
$totalamount += (intval($row3['LevelS']) + intval($row3['BonusS']));


$sql = "UPDATE LevelBonus SET status=1 where `userid` = '$uid' and `sdate`<'$ttstamp' and `status`=0";
mysqli_query($con, $sql);

$sql = "UPDATE `payourplan` SET status=1  where `userid` = '$uid' and `date`<'$ttstamp' and `status` = 0";
mysqli_query($con, $sql);

$sql = "INSERT INTO `userpaid` (`ID`, `Amount`, `userid`, `date`) VALUES (NULL, '$totalamount', '$uid', now());";
mysqli_query($con, $sql);

echo "Paid Successfully";
