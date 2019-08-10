<?php

include "config.php";
if ($_SESSION['login'] != "logged") {
    die();
}
$email = $_SESSION['email'];
$arr1 = [];
$arr2 = [];
$arr3 = [];
$arr4 = [];
$arr5 = [];
$arr6 = [];
$arr7 = [];
$arr8 = [];
$arr9 = [];
$arr10 = [];

$checksql = "Select * from Users where `username`='$email'";
$checktokenrst = mysqli_query($con, $checksql);
$tokenrow = mysqli_fetch_assoc($checktokenrst);

if (isset($_REQUEST['ID'])) {
    $oref = "PC00" . $_REQUEST['ID'];
    //echo intval($_REQUEST['ID']);echo " ".intval($tokenrow['ID']);

    if (intval($tokenrow['ID'])>intval($_REQUEST['ID']))
    {
        //echo "In";
        die();
    }
} else {
    $oref = "PC00" . $tokenrow['ID'];
}

$allin = "'$oref'";
$sumall=0;
$allin1= "'PC00".$tokenrow['ID']."'";
for ($i = 0; $i < 10; $i++) {
    if ($allin!='') {
        $checksql1 = "Select Users.ID,(allplan.plan) from Users JOIN allplan on Users.plan = allplan.ID where `referalcode` In($allin) and Users.step >=4";
        $rst = mysqli_query($con, $checksql1);
        $allin="";
        while ($row = mysqli_fetch_assoc($rst)) {
            if ($oref != "PC00" . $row['ID']) {
                $allin .= "'PC00" . $row['ID']."',";
                $sumall = $sumall+intval($row['plan']);
            }
        }
        $allin = substr(trim($allin), 0, -1);
    }
}

$allin1= "'PC00".$tokenrow['ID']."'";
$allin = $allin1;
for ($i = 0; $i < 10; $i++) {
    if ($allin!='') {
        $checksql1 = "Select Users.ID,(allplan.plan) from Users JOIN allplan on Users.plan = allplan.ID where `referalcode` In($allin) and Users.step >=4";
        $rst = mysqli_query($con, $checksql1);
        $allin="";
        while ($row = mysqli_fetch_assoc($rst)) {
            if ($oref != "PC00" . $row['ID']) {
                $allin .= "'PC00" . $row['ID']."',";
                $allin1 .= "'PC00" . $row['ID']."',";
                $sumall = $sumall+intval($row['plan']);
            }
        }
        $allin = substr(trim($allin), 0, -1);
    }
}

$sss="PC00" . $tokenrow1['ID'];
$ss1 = "PC00" . $tokenrow['ID'];
if ($sss == $allin1)
{

}else {
    $arr = explode($ss1,$allin1);
    if (count($arr)==1)
    {
        die;
    }
}

//echo "final".$allin1;
$checksql1 = "Select * from Users where `referalcode`='$oref'";
$checktokenrst1 = mysqli_query($con, $checksql1);

$str = "";
while ($tokenrow1 = mysqli_fetch_assoc($checktokenrst1)) {
    if ($oref != "PC00" . $tokenrow1['ID']) {
        $arr1 = [];
        $sqlinfo = "Select * from allplan where `ID`='" . $tokenrow1['plan'] . "'";
        $checktokenrst2 = mysqli_query($con, $sqlinfo);
        $tokenrow2 = mysqli_fetch_assoc($checktokenrst2);
        $cls = "";
        if ($tokenrow1['step'] < 3) {
            $cls = "fa-warning icon-state-danger";
        }
        $str .= '<li  role="treeitem" aria-selected="false" aria-level="1" aria-labelledby="j1_1_anchor" aria-expanded="true" id="j1_1" class="jstree-node jstree-open"><i class="jstree-icon jstree-ocl" role="presentation"></i><a class="jstree-anchor" href="javascript:getMyTree(' . $tokenrow1['ID'] . ')" tabindex="-1" id="j1_1_anchor" style="    text-transform: uppercase;"><i class="jstree-icon jstree-themeicon fa fa-folder icon-state-warning icon-lg jstree-themeicon-custom ' . $cls . '" role="presentation"></i> ' . $tokenrow1['firstname'] . " " . $tokenrow1['lastname'] . ' <span style="    color: #00d800;">Plan ' . $tokenrow2['plan'] . '</span>
        </a><div id="tree' . $tokenrow1['ID'] . '"></div>';
        $str .= '</li>';
    }
}


if ($str != "") {
    if ($email == "ProventureCap") {
        echo "<p>Total Tree Value INR $sumall </p>";
    }
    echo '<ul class="jstree-container-ul jstree-children" role="group">';
    echo $str;
    echo "</ul>";
}
