<?php

include "helper/header.php";
include "helper/config.php";

$email =  $_SESSION['userid'];

$quote = [
  "Finance is not merely about making money. It's about achieving our deep goals and protecting the fruits of our labor. It's about stewardship and, therefore, about achieving the good society.",
  "A budget tells us what we can't afford, but it doesn't keep us from buying it.",
  "Beware of little expenses. A small leak will sink a great ship."
];


$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);


$checksql = "Select * from kycdetails where `userid`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserBankInfo = mysqli_fetch_assoc($checkrst);


$checksql1 = "Select * from kycdetailsapproval WHERE `userid` = '$email' and `status`=0";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);


$page = "support";
include "./common/header.php";
include "./common/sidebar.php";
?>

      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-user" id="profile">
              <div class="card-header">
              <h5 class="card-title sbcc"><span style="color: #66615B;font-weight: bold;">Send you Enquiry</span></h5> 
              </div>
              <div class="card-body">
              <form method="POST" action="/SubmitQuery">
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Username (disabled)</label>
                        <input required type="text" class="form-control" disabled="" placeholder="Company" value="<?php echo $UserInfo['username']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Subject</label>
                        <input required type="text" class="form-control" placeholder="Subject" name='subject'>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Query(please do discribe your quey for us to understand and help)</label>
                        <textarea required type="text" class="form-control" placeholder="Query" name='query'></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Submit Query</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "./common/footer1.php";?>
    </div>
  </div>
<?php include "./common/footer.php";?>
