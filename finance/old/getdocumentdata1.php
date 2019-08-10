<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$plan = intval($UserInfo['step']);
if ($plan < 3 || $email != 1) {
    die();
}

$uid=$_REQUEST['uid'];
$checksql = "Select username,tranferdetails,transferdate,recipt,topup.amount as qty from userpayment join Users on Users.ID=userpayment.userid join topup on Users.ID=topup.userid where userpayment.`planid`='$uid'";
$checkrst1 = mysqli_query($con, $checksql);
$UserInfo1 = mysqli_fetch_assoc($checkrst1);


?>
<h5 class="modal-title" style="color:#429195;padding-bottom: 10px;text-align: center;"><?php echo $UserInfo1['username']; ?> Amount: <?php echo $UserInfo1['qty']; ?></h5>


<?php if ($UserInfo1['transferdate'] == '' ){  ?>
<img src="<?php echo $UserInfo1['recipt'];?>" stype="width: 200px">
<?php }else {?>
    <p style="color:black;    text-align: center;">Transaction Deatils  <span style="font-weight:bold"><?php echo $UserInfo1['tranferdetails'];?></span><p>
<p style="color:black;    text-align: center;">Transaction Date <span style="font-weight:bold"><?php echo $UserInfo1['transferdate'];?></span><p>
    <?php }?>
