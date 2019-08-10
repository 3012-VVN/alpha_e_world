<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];


$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan <3)
{
  header('Location: Login');
}



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

$checksql1 = "SELECT * FROM `topup` where `step`< 4 and `userid`='$email'";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);
$UserBankInfo1 = mysqli_fetch_assoc($checkrst1);

if ($rowcount1 ==1)
{
    $plan = intval($UserBankInfo1['step']);
}else {
    $plan =0;
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
    include "common/selectplan1.php";

} else if ($plan == 1) {
    include "common/paymentinfo1.php";
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