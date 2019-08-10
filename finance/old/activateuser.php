<?php

date_default_timezone_set("Europe/Belgrade");
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
    //header('Location: Login');
    die();
}

$ID = $_REQUEST['uid'];
$checksql = "Select * from Users where `ID`='$ID'";
$checkrst1 = mysqli_query($con, $checksql);
$UserInfo1 = mysqli_fetch_assoc($checkrst1);
$unique = $UserInfo1['joinkey'];
$checksql = "Select * from inviteuser where `unique`='$unique'";
$checkrst = mysqli_query($con, $checksql);
$inviteuser = mysqli_fetch_assoc($checkrst);

if ($UserInfo1['plan'] == 1) {
    $rate = 1;
} else if ($UserInfo1['plan'] == 2) {
    $rate = 1;
} else if ($UserInfo1['plan'] == 3) {
    $rate = 1;
}

$qty = intval($UserInfo1['qty']);

if (intval($_REQUEST['bool']) == 1) {
    $val = 4;
    $msg = "User has been Activated";

    if ($inviteuser['status'] == 3) {
        $sql = "Update inviteuser set status=4 where `unique`='$unique'";
        mysqli_query($con, $sql);
    }

    echo $checksql4 = "SELECT * from payourplan WHERE `userid`='$ID'";
    $checkrst4 = mysqli_query($con, $checksql4);
    echo $inactiveuser4 = mysqli_num_rows($checkrst4);
    if ($inactiveuser4 == 0) {
        $amount = $qty * $rate * 2;
        $perday = $amount / 200;

        //$sql = "DELETE from payourplan WHERE `userid`='$ID'";
        //mysqli_query($con, $sql);
        $Date = $UserInfo1['joindate']; //date("Y-m-d");
        if ($val == 4) {
            $ii = 1;
            for ($i = 1; $i <= 200; $i++) {
                $int = strtotime($Date . ' + ' . $ii . ' days');
                $day = date('l', $int);

                if ($day == "Sunday" || $day == "Saturday") {
                    $i--;
                } else {
                    date('d-m-Y', $int);
                    $inst = "INSERT INTO `payourplan` (`ID`, `userid`, `amount`, `date`,`sdate`, `status`,`planid`) VALUES (NULL, '$ID', '$perday', '$int','" . date('Y-m-d', $int) . "',0,0);";
                    mysqli_query($con, $inst);
                }
                $ii++;
            }
        }
        //----------------------------------------------------
        //Level 1
        $checksql = "Select * from Users where `ID`='$ID'";
        $checkrst = mysqli_query($con, $checksql);
        $referalog = mysqli_fetch_assoc($checkrst);

        //----
        $ref = $referalog['referalcode'];
        $checksql3 = "SELECT * FROM `Users` WHERE `referalcode` = '$ref' and `step`=4";
        $checkrst3 = mysqli_query($con, $checksql3);
        $inactiveuser3 = mysqli_num_rows($checkrst3);

        $inactiveuser1 = $inactiveuser3++;
        $bal = 10;
        if ($inactiveuser1 >= 6 && $inactiveuser1 <= 8) {
            $bal = 12.5;
        } elseif ($inactiveuser1 >= 9 && $inactiveuser1 <= 12) {
            $bal = 12.5;
        } elseif ($inactiveuser1 > 12) {
            $bal = 15;
        }
        //echo $bal;
        //-----

        $code = intval(str_replace("A", "", $referalog['referalcode']));
        $amount = intval($referalog['qty']) * ($bal / 100);

        $planid = 0;

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
//--------------------------------------

    $inactiveuser3++;
    if ($UserInfo['leafno']>0) {
        $sql = "UPDATE `Users` SET `step` = '4' WHERE `Users`.`ID` = $ID;";
    }else {
        $sql = "UPDATE `Users` SET `step` = '4',`leafno`='$inactiveuser3' WHERE `Users`.`ID` = $ID;";
    }
    mysqli_query($con, $sql);
} else {
    $val = 2;
    $msg = "User has been Deactivated";

    if ($inviteuser['status'] == 4) {
        $sql = "Update inviteuser set status=3 where `unique`='$unique'";
        mysqli_query($con, $sql);
    }

    $sql = "UPDATE `Users` SET `step` = '2' WHERE `Users`.`ID` = $ID;";
    mysqli_query($con, $sql);

}

echo $msg;
