<?php

include "helper/header.php";
include "helper/config.php";

$email =  $_SESSION['userid'];

$quote = [
  "Finance is not merely about making money. It's about achieving our deep goals and protecting the fruits of our labor. It's about stewardship and, therefore, about achieving the good society.",
  "A budget tells us what we can't afford, but it doesn't keep us from buying it.",
  "Beware of little expenses. A small leak will sink a great ship."
];

if ($email!=1)
{
  //echo $email;
  die();
}

//$email = $_REQUEST['id'];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);


$checksql = "Select * from kycdetails where `userid`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserBankInfo = mysqli_fetch_assoc($checkrst);


$checksql1 = "Select * from kycdetailsapproval WHERE `userid` = '$email' and `status`=0";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);


$page = "user";
include "./common/header.php";
include "./common/sidebar.php";

$ss='';
$ss1='disabled';
if (isset($_REQUEST['state']))
{
  $ss=$_REQUEST['state'];
  $ss1='';
}
$ss3='disabled';
if (isset($_REQUEST['astate']))
{
  $ss2=$_REQUEST['astate'];
  $ss3='';
}

$email = $_REQUEST['id'];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);


$checksql = "Select * from kycdetails where `userid`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserBankInfo = mysqli_fetch_assoc($checkrst);


$checksql1 = "Select * from kycdetailsapproval WHERE `userid` = '$email' and `status`=0";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);



?>

      <div class="content">
        <div class="row">
          <div class="col-md-4">
            <?php include "./common/pp.php";?>
            <div class="card">
              <div class="card-header">
                <h4 class="card-title">Trade Buddies</h4>
              </div>
              <div class="card-body">
              <?php include "./common/teammember.php"; ?>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-user" id="profile">
              
              <div class="card-body">
              <?php if ($ss !=''){ ?>
              
              <?php }?>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Username (disabled)</label>
                        <input required type="text" class="form-control" disabled placeholder="Company" value="<?php echo $UserInfo['username']; ?>">
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Mobile</label>
                        <input required type="text" class="form-control" <?php echo $ss1;?> placeholder="Mobile" name='mobile' value="<?php echo $UserInfo['mobile']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input required type="email" class="form-control" <?php echo $ss1;?> placeholder="Email" name='email' value="<?php echo $UserInfo['email']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input required type="text" class="form-control" <?php echo $ss1;?> placeholder="First Name" name='firstname' value="<?php echo $UserInfo['firstname']; ?>">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input required type="text" class="form-control" <?php echo $ss1;?> placeholder="Last Name" name='lastname' value="<?php echo $UserInfo['lastname']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Address</label>
                        <input required type="text" class="form-control" <?php echo $ss1;?> placeholder="Home Address" name='address' value="<?php echo $UserInfo['address']; ?>">
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                  <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Country</label>
                        <input required type="text" class="form-control" <?php echo $ss1;?> placeholder="Country" name='country' value="<?php echo $UserInfo['country']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>City</label>
                        <input required type="text" class="form-control" <?php echo $ss1;?> placeholder="City" name='city' value="<?php echo $UserInfo['city']; ?>">
                      </div>
                    </div>
                    
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Area Code</label>
                        <input required type="number" class="form-control" <?php echo $ss1;?> placeholder="ZIP Code" name='pincode' value="<?php echo $UserInfo['pincode']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>About Me</label>
                        <textarea class="form-control textarea" <?php echo $ss1;?> name='aboutme'><?php echo $UserInfo['aboutme']; ?></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Username (disabled)</label>
                        <input required type="text" class="form-control" disabled="" placeholder="Company" value="<?php echo $UserInfo['username']; ?>">
                        
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>PAN Card(for India)</label>
                        <input  type="text" class="form-control" <?php echo $ss3;?> placeholder="PAN Card" name='pancard' value="<?php echo $UserBankInfo['pancard']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                      <select name='cardtype'  <?php echo $ss3;?> style='    width: 80%;
    background-color: white;'>

                                  <option value='1' <?php if ($UserBankInfo['cardtype']==1){echo 'selected';}; ?> >Passport</option>
                                  <option value='2' <?php if ($UserBankInfo['cardtype']==2){echo 'selected';}; ?>>National Id</option>
                                  <option value='3' <?php if ($UserBankInfo['cardtype']==3){echo 'selected';}; ?>>Aadhar</option>
                                  <option value='4' <?php if ($UserBankInfo['cardtype']==4){echo 'selected';}; ?>>Other</option>
                                  </select>
                       <input required type="text" class="form-control" <?php echo $ss3;?> placeholder="ID Number" name='adharcard' value="<?php echo $UserBankInfo['adharcard']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Bank Name</label>
                        <input required type="text" class="form-control" <?php echo $ss3;?> placeholder="Bank Name" name='bankname' value="<?php echo $UserBankInfo['bankname']; ?>">
                        
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Account Holder Name</label>
                        <input required type="text" class="form-control" <?php echo $ss3;?> placeholder="Account Holder Name" name='accname' value="<?php echo $UserBankInfo['accname']; ?>">
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Account Number</label>
                        <input required type="text" class="form-control" <?php echo $ss3;?> placeholder="Account Number" name='accno' value="<?php echo $UserBankInfo['accno']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>IFSC Code(for India)</label>
                        <input type="text" class="form-control" <?php echo $ss3;?> placeholder="IFSC Code" name='ifsccode' value="<?php echo $UserBankInfo['ifsccode']; ?>">
                      </div>
                    
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>IBAN Code</label>
                        <input required type="text" class="form-control" <?php echo $ss3;?> placeholder="Swift Code" name='swiftcode' value="<?php echo $UserBankInfo['swiftcode']; ?>">
                      </div>
                    </div>
                  </div>
                  
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "./common/footer1.php";?>
    </div>
  </div>
<?php include "./common/footer.php";?>
<script>
  $(document).ready(function(){
    $('.account').click(function(){
      $("#account").show();
      $("#profile").hide();
      window.location.href = "UserInfo#Bank";
    });
    $('.profile').click(function(){
      $("#account").hide();
      $("#profile").show();
      window.location.href = "UserInfo";
    });

    var hash = location.hash.substr(1);
   
    if (hash=="Bank")
    {
      console.log(hash);
      $("#account").show();
      $("#profile").hide();
    }
    

  })

  </script>

  <style>
    .sbcc{
      border-bottom: #65615a33;
    border-style: solid;
    border-top: none;
    border-right: none;
    border-left: none;
    border-width: 1px;
    }
    </style>