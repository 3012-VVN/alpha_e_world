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

$checksql = "Select * from kycdetails where `userid`='$email'";
$checkrst = mysqli_query($con, $checksql);
$rowcount2 = mysqli_num_rows($checkrst);
$UserBankInfo = mysqli_fetch_assoc($checkrst);

$checksql1 = "Select * from kycdetailsapproval WHERE `userid` = '$email' and `status`=0";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);


$plan = intval($UserInfo['step']);

if ($email ==1)
{
    $checksql2 = "SELECT sum(`qty`) as total FROM `Users` WHERE `step` = '4' ";
    $checkrst2 = mysqli_query($con, $checksql2);
    $payoutincome = mysqli_fetch_assoc($checkrst2);

    $checksql21 = "SELECT sum(`amount`) as total FROM `topup` WHERE `step` = '4' ";
    $checkrst21 = mysqli_query($con, $checksql21);
    $payoutincome1 = mysqli_fetch_assoc($checkrst21);

    $qty= $payoutincome['total']+$payoutincome1['total'];

    $checksql2 = "SELECT * FROM `inviteuser` WHERE `status`=0";
    $checkrst2 = mysqli_query($con, $checksql2);
    $inprocess1 = mysqli_num_rows($checkrst2);

    $checksql2 = "SELECT * FROM `inviteuser` WHERE `status`=4";
    $checkrst2 = mysqli_query($con, $checksql2);
    $activeuser = mysqli_num_rows($checkrst2);

    $checksql2 = "SELECT * FROM `inviteuser` WHERE`status`!=4 and `status`!=0";
    $checkrst2 = mysqli_query($con, $checksql2);
    $inactiveuser = mysqli_num_rows($checkrst2);

    $timestamp = strtotime("now");
    $checksql2 = "SELECT sum(`amount`) as total FROM `payourplan` WHERE `date`<$timestamp and `status`=0";
    $checkrst2 = mysqli_query($con, $checksql2);
    $payoutincome = mysqli_fetch_assoc($checkrst2);

    $dailygeneration=floatval($payoutincome['total']);

    $checksql3 = "SELECT sum(`Level`) as total FROM `LevelBonus` where `status`=0";
    $checkrst3 = mysqli_query($con, $checksql3);
    $payoutincome1 = mysqli_fetch_assoc($checkrst3);

    $levelgeneration=floatval($payoutincome1['total']);

    $checksql3 = "SELECT sum(`Bonus`) as total FROM `LevelBonus` where `status`=0";
    $checkrst3 = mysqli_query($con, $checksql3);
    $payoutincome2 = mysqli_fetch_assoc($checkrst3);

    $bonusgeneration=floatval($payoutincome2['total']);

    $checksql3 = "SELECT sum(`amount`) as total FROM `userpaid`";
    $checkrst3 = mysqli_query($con, $checksql3);
    $payoutincome4 = mysqli_fetch_assoc($checkrst3);

    $totalgeneration=floatval($payoutincome4['total']);;//$dailygeneration+$levelgeneration+$bonusgeneration;




}else {
    $qty= $UserInfo['qty'];
    $checksql2 = "SELECT * FROM `inviteuser` WHERE `userid` = '$email' and`status`=0";
    $checkrst2 = mysqli_query($con, $checksql2);
    $inprocess1 = mysqli_num_rows($checkrst2);

    $checksql2 = "SELECT * FROM `inviteuser` WHERE `userid` = '$email' and `status`=4";
    $checkrst2 = mysqli_query($con, $checksql2);
    $activeuser = mysqli_num_rows($checkrst2);

    $checksql2 = "SELECT * FROM `inviteuser` WHERE `userid` = '$email' and `status`!=4 and `status`!=0";
    $checkrst2 = mysqli_query($con, $checksql2);
    $inactiveuser = mysqli_num_rows($checkrst2);



    // $checksql = "Select * from payourplan where `userid`='$email'";
    $timestamp = strtotime("now");
    $checksql2 = "SELECT sum(`amount`) as total FROM `payourplan` WHERE `userid` = '$email' and `date`<$timestamp and `status`=0";
    $checkrst2 = mysqli_query($con, $checksql2);
    $payoutincome = mysqli_fetch_assoc($checkrst2);


    $dailygeneration=floatval($payoutincome['total']);

    $checksql3 = "SELECT sum(`Level`) as total FROM `LevelBonus` WHERE `userid` = '$email' and `status`=0";
    $checkrst3 = mysqli_query($con, $checksql3);
    $payoutincome1 = mysqli_fetch_assoc($checkrst3);

    $levelgeneration=floatval($payoutincome1['total']);

    $checksql3 = "SELECT sum(`Bonus`) as total FROM `LevelBonus` WHERE `userid` = '$email' and `status`=0";
    $checkrst3 = mysqli_query($con, $checksql3);
    $payoutincome2 = mysqli_fetch_assoc($checkrst3);

    $bonusgeneration=floatval($payoutincome2['total']);


    $checksql3 = "SELECT sum(`amount`) as total FROM `userpaid` where userid='$email'";
    $checkrst3 = mysqli_query($con, $checksql3);
    $payoutincome4 = mysqli_fetch_assoc($checkrst3);

    $totalgeneration=floatval($payoutincome4['total']);;//$dailygeneration+$levelgeneration+$bonusgeneration;
}
include "./common/header.php";
include "./common/sidebar.php";
?>

<style>
.perfect-scrollbar-on .main-panel{
    background-size: cover !important;
    background-repeat: no-repeat !important;
}
    .footer-nav ul li p{
        color:#fff !important;
        font-weight: bold;
    }
    .footer-nav a{
        color:white !important;
        font-weight: bold;
    }
    .credits{
        color:white !important;
        font-weight: bold;
    }

</style>
<div class="content">
<?php if ($rowcount2==0 && $plan>=3) {?>
      

      <div class="alert alert-warning" style="    background-color: #797979;">
  <strong>Warning!</strong> Kindly Update Your Bank Details.<a href="/UserInfo#Bank" style="font-weight: bold;"> For Update Click Here</a>
</div>


        <?php
        }
if ($plan == 0) {
    include "common/selectplan.php";

} else if ($plan == 1) {
    include "common/paymentinfo.php";
} else if ($plan == 2) {

    $unique = $UserInfo['joinkey'];
    $checksql = "Select * from inviteuser where `unique`='$unique'";
    $checkrst = mysqli_query($con, $checksql);
    $inviteuser = mysqli_fetch_assoc($checkrst);

    if ($inviteuser['status'] == 2) {
        $sql = "Update inviteuser set status=3 where `unique`='$unique'";
        mysqli_query($con, $sql);
    }

    include "common/thanks.php";
} else if ($plan >= 3) {
    include "common/dash.php";
}
?>
      </div>
      <?php include "./common/footer1.php";?>
    </div>
  </div>
<?php include "./common/footer.php";?>

<script>
    $(document).ready(function(){
        setTimeout(qq,1000);
    });

    function qq(){
        $.post( "/Timer", { name: "John", time: "2pm" })
        .done(function( data ) {
            $("#timer").html(data);
            setTimeout(qq,1000);
        });
    }
</script>