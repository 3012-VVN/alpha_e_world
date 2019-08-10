<?php

date_default_timezone_set("Europe/Belgrade");
include "helper/config.php";

$email = $_SESSION['userid'];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($email != 1) {
    //header('Location: Login');
    die();
}

$uid = $_REQUEST['uid'];

echo $checksql1 = "SELECT * FROM `topup` where `step`=2 and `ID`='$uid'";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);
$UserBankInfo1 = mysqli_fetch_assoc($checkrst1);

//$amount = intval($_REQUEST['qty']);
if ($rowcount1 == 1) {

    if ($UserBankInfo1['sdate'] == 1 || $UserBankInfo1['sdate'] == 0) {
        $tt = strtotime('now');
        $sql = "UPDATE topup SET sdate='$tt' where `ID`='$uid'";
        mysqli_query($con, $checksql1);
        $Date = date('Y-m-d');
    } else {
        $Date = date('Y-m-d', intval($UserBankInfo1['sdate']));
    }

    $ID = $UserBankInfo1['userid'];
    $checksql = "Select * from Users where `ID`='$ID'";
    $checkrst1 = mysqli_query($con, $checksql);
    $UserInfo1 = mysqli_fetch_assoc($checkrst1);

    $qty = floatval($UserBankInfo1['amount']);

    $msg = "TopUp has been Activated";

    echo $checksql4 = "SELECT * from payourplan WHERE `userid`= '$ID' and `planid`='$uid'";
    $checkrst4 = mysqli_query($con, $checksql4);
    $inactiveuser4 = mysqli_num_rows($checkrst4);
    if ($inactiveuser4 == 0) {
        $amount = $qty * 2;
        $perday = $amount / 200;

        //$Date = $UserInfo1['joindate'];

        $ii = 1;
        for ($i = 1; $i <= 200; $i++) {
            $int = strtotime($Date . ' + ' . $ii . ' days');
            $day = date('l', $int);

            if ($day == "Sunday" || $day == "Saturday") {
                $i--;
            } else {
                date('d-m-Y', $int);
                $inst = "INSERT INTO `payourplan` (`ID`, `userid`, `amount`, `date`,`sdate`, `status`,`planid`) VALUES (NULL, '$ID', '$perday', '$int','" . date('Y-m-d', $int) . "', 0,$uid);";
                mysqli_query($con, $inst);
            }
            $ii++;
        }

        //Level 1
        echo $checksql = "Select topup.amount as qty,topup.userid,Users.referalcode from topup Join Users on Users.ID=topup.userid where topup.`ID`=$uid";
        $checkrst = mysqli_query($con, $checksql);
        $referalog = mysqli_fetch_assoc($checkrst);

        echo $ref = $referalog['referalcode'];
        $checksql3 = "SELECT * FROM `Users` WHERE `referalcode` = '$ref' and `step`=4";
        $checkrst3 = mysqli_query($con, $checksql3);
        $inactiveuser3 = mysqli_num_rows($checkrst3);

        $inactiveuser1 = intval($UserInfo1['leafno']);
        $bal = 10;
        if ($inactiveuser1 >= 6 && $inactiveuser1 <= 8) {
            $bal = 12.5;
        } elseif ($inactiveuser1 >= 9 && $inactiveuser1 <= 12) {
            $bal = 12.5;
        } elseif ($inactiveuser1 > 12) {
            $bal = 15;
        }

        $code = intval(str_replace("A", "", $referalog['referalcode']));
        $amount = intval($referalog['qty']) * ($bal / 100);

        $planid = $_REQUEST['uid'];

        $checksql2 = "SELECT * FROM `LevelBonus` WHERE `userid`='$code' and `fuserid` = '$ID' and `levelno`=1 and `planid`=$planid";
        $checkrst2 = mysqli_query($con, $checksql2);
        $inactiveuser = mysqli_num_rows($checkrst2);

        $ss = strtotime('now');
        if ($inactiveuser == 0) {
            $sql = "INSERT INTO `LevelBonus` (`ID`, `userid`, `fuserid`, `Level`, `Bonus`,`levelno`, `Date`,`sdate`,`status`,`planid`) VALUES (NULL, '$code', '$ID', '$amount', '0',1, now(),$ss,0,$planid);";
            mysqli_query($con, $sql);

            if ($code != 1) {
                //Level 2
                $checksql = "Select * from Users where `ID`='$code'";
                $checkrst = mysqli_query($con, $checksql);
                $referal = mysqli_fetch_assoc($checkrst);

                $code1 = intval(str_replace("A", "", $referal['referalcode']));
                $amount1 = intval($referalog['qty']) * (3 / 100);

                $checksql2 = "SELECT * FROM `LevelBonus` WHERE `userid`='$code1' and  `fuserid` = '$ID' and `levelno`=2  and `planid`=$planid";
                $checkrst2 = mysqli_query($con, $checksql2);
                $inactiveuser = mysqli_num_rows($checkrst2);
                if ($inactiveuser == 0) {
                    $sql = "INSERT INTO `LevelBonus` (`ID`, `userid`, `fuserid`, `Level`, `Bonus`,`levelno`, `Date`,`sdate`,`status`,`planid`) VALUES (NULL, '$code1', '$ID', '$amount1', '0',2, now(),$ss,0,$planid);";
                    mysqli_query($con, $sql);
                }

                if ($code1 != 1) {
                    //Level 3
                    $checksql = "Select * from Users where `ID`='$code1'";
                    $checkrst = mysqli_query($con, $checksql);
                    $referal = mysqli_fetch_assoc($checkrst);

                    $code2 = intval(str_replace("A", "", $referal['referalcode']));
                    $amount2 = intval($referalog['qty']) * (2 / 100);
                    $checksql2 = "SELECT * FROM `LevelBonus` WHERE `userid`='$code2' and  `fuserid` = '$ID' and `levelno`=3  and `planid`=$planid";
                    $checkrst2 = mysqli_query($con, $checksql2);
                    $inactiveuser = mysqli_num_rows($checkrst2);
                    if ($inactiveuser == 0) {
                        $sql = "INSERT INTO `LevelBonus` (`ID`, `userid`, `fuserid`, `Level`, `Bonus`,`levelno`, `Date`,`sdate`,`status`,`planid`) VALUES (NULL, '$code2', '$ID', '$amount2', '0',3, now(),$ss,0,$planid);";
                        mysqli_query($con, $sql);
                    }

                    //$code = intval(str_replace("A", "", $referalog['referalcode']));
                    $checksql3 = "SELECT * FROM Users where ID='$code1'";
                    $checkrst3 = mysqli_query($con, $checksql3);
                    $row3 = mysqli_fetch_assoc($checkrst3);
                    //var_dump($row3);
                    $amount = intval($row3['qty']) * (5 / 100);

                    $checksql2 = "SELECT * FROM `LevelBonus` WHERE `userid`='$code2' and `fuserid` = '$code1' and `levelno`=4  and `planid`=$planid";
                    $checkrst2 = mysqli_query($con, $checksql2);
                    $inactiveuser = mysqli_num_rows($checkrst2);
                    if ($inactiveuser == 0) {
                        $sql = "INSERT INTO `LevelBonus` (`ID`, `userid`, `fuserid`, `Level`, `Bonus`,`levelno`, `Date`,`sdate`,`status`,`planid`) VALUES (NULL, '$code2', '$code1', '$amount', '0',4, now(),$ss,0,$planid);";
                        mysqli_query($con, $sql);
                    }
                }
            }
        }
    }
}

echo $sql = "UPDATE `topup` SET `step` = '4' WHERE `ID` =$uid;";
mysqli_query($con, $sql);
echo $msg;
