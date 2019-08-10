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

$plan = intval($UserInfo['step']);
if ($plan <3)
{
  header('Location: Login');
}


$checksql = "Select * from kycdetails where `userid`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserBankInfo = mysqli_fetch_assoc($checkrst);


$checksql1 = "Select * from kycdetailsapproval WHERE `userid` = '$email' and `status`=0";
$checkrst1 = mysqli_query($con, $checksql1);
$rowcount1 = mysqli_num_rows($checkrst1);

  $page="inviteuser";
  include "./common/header.php";
  include "./common/sidebar.php";
?>

      <div class="content">
        <div class="row">
          <div class="col-md-4">
          <?php include "./common/pp.php";?>
            <div class="card" style="display:none;">
              <div class="card-header" style="display:none;">
                <h4 class="card-title">Team Members</h4>
              </div>
              <div class="card-body">
                <ul class="list-unstyled team-members">
                  <li>
                    <div class="row">
                      <div class="col-md-2 col-2">
                        <div class="avatar">
                          <img src="../assets/img/faces/ayo-ogunseinde-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                        </div>
                      </div>
                      <div class="col-md-7 col-7">
                        DJ Khaled
                        <br />
                        <span class="text-muted">
                          <small>Offline</small>
                        </span>
                      </div>
                      <div class="col-md-3 col-3 text-right">
                        <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="row">
                      <div class="col-md-2 col-2">
                        <div class="avatar">
                          <img src="../assets/img/faces/joe-gardner-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                        </div>
                      </div>
                      <div class="col-md-7 col-7">
                        Creative Tim
                        <br />
                        <span class="text-success">
                          <small>Available</small>
                        </span>
                      </div>
                      <div class="col-md-3 col-3 text-right">
                        <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
                      </div>
                    </div>
                  </li>
                  <li>
                    <div class="row">
                      <div class="col-md-2 col-2">
                        <div class="avatar">
                          <img src="../assets/img/faces/clem-onojeghuo-2.jpg" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                        </div>
                      </div>
                      <div class="col-ms-7 col-7">
                        Flume
                        <br />
                        <span class="text-danger">
                          <small>Busy</small>
                        </span>
                      </div>
                      <div class="col-md-3 col-3 text-right">
                        <btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa fa-envelope"></i></btn>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-8">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Invite Buddies</h5>
              </div>
              <div class="card-body">
              <form method="POST" action="/InviteNewUser">
                  
                  <div class="row">
                    <div class="col-md-12 pr-1">
                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Full Name" value="" required>
                      </div>
                    </div>
                  </div>
                  
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" placeholder="username@example.com" value="" required>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Mobile</label>
                        <input type="hidden" class="form-control" name="countrycode" id="countrycode" placeholder="8888888888" value="" required>
                        <input type="number" class="form-control" name="mobile" id="usermobile" placeholder="8888888888" value="" required>
                      </div>
                    </div>
                    
                  </div>
                  
                  <div class="row">
                    <div id="msg" style="
    width: 100%;
"></div>
                    <div class="update ml-auto mr-auto">
                      <button type="submit" class="btn btn-primary btn-round">Send Invite</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
    <div class="card">
              <div class="card-header">
                <h4 class="card-title">Trade Buddies</h4>
              </div>
              <div class="card-body">
               <?php include "./common/teammember.php"; ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php include "./common/footer1.php"; ?>
    </div>
  </div>
<?php include "./common/footer.php"; ?>


<script>
 
  $(document).ready(function(){
    var hash = location.hash.substr(1);
   
    if (hash=="success")
    {
      $("#msg").html('<p style="padding: 10px;color: green;">Invitation succesfully processed. Invitation will be sent in next 10 minutes.</p>');

    }else if (hash=="alreadymember")
    {
      $("#msg").html('<p style="padding: 10px;color: orange;">The invited user has exceeded fair usage policy</p>');
    }

    var input1 = document.querySelector("#usermobile");
   
    value1 = intlTelInput(input1, {
        initialCountry: "auto",separateDialCode:false,
        geoIpLookup: function(success, failure) {
          $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            success(countryCode);
          });
        },
      });
      //console.log(value1.getSelectedCountryData());
      input1.addEventListener("countrychange", function() {
        // do something with iti.getSelectedCountryData()
        //console.log(iti.getSelectedCountryData());
        //$("#countrycode").val(countryCode);
        var countryData= (value1.getSelectedCountryData());
        
        console.log(countryData.dialCode);
        $("#countrycode").val(countryData.dialCode);
      });

  })
  var value1 
  </script>