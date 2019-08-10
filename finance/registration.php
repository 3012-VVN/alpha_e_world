<?php

include "helper/header.php";
include "helper/config.php";
$_title .= " Registration";

$referalcode = $_REQUEST['referalcode'];
if ($referalcode == "") {$referalcode = '91';}
$firstname = "";
$lastname = "";
$mobile = "";
$email = "";
if (isset($_REQUEST['token'])) {
    $unique = $_REQUEST['token'];
    $checksql = "Select * from inviteuser where `unique`='$unique'";
    $checkrst = mysqli_query($con, $checksql);
    $inviteuser = mysqli_fetch_assoc($checkrst);
    $count = mysqli_num_rows($checkrst);
    if ($count == 1) {
        $arr = explode(" ", $inviteuser['name']);
        $firstname = $arr[0];
        if (count($arr) > 1) {
            $lastname = $arr[1];
        }
        $mobile = $inviteuser['mobile'];
        $email = $inviteuser['email'];

        if ($inviteuser['status'] == 0) {
            $sql = "Update inviteuser set status=1 where `unique`='$unique'";
            mysqli_query($con, $sql);
        }
        $checksql = "Select * from `Users` where `joinkey`='$unique'";
        $checkrst = mysqli_query($con, $checksql);
        $count1 = mysqli_num_rows($checkrst);
        if ($count1 == 1) {
            $count = 0;
        }
	}

}
	//to be commented
	$count = 1;
?>
<!DOCTYPE html>

<html lang="en" class="perfect-scrollbar-off gr__demos_creative-tim_com">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
    <?php echo $_title; ?>
  </title>

	<!-- Canonical SEO -->
    <link rel="canonical" href="https://www.creative-tim.com/product/paper-dashboard-pro">

	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">


     <!-- Bootstrap core CSS     -->
    <link href="./registration_files/bootstrap.min.css" rel="stylesheet">

    <!--  Paper Dashboard core CSS    -->
    <link href="./registration_files/paper-dashboard.css" rel="stylesheet">


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="./registration_files/demo.css" rel="stylesheet">
	<link href="../tel/intlTelInput.min.css" rel="stylesheet">

    <!--  Fonts and icons     -->
    <link href="./registration_files/font-awesome.min.css" rel="stylesheet">
    <link href="./registration_files/css" rel="stylesheet" type="text/css">
	<link href="./registration_files/themify-icons.css" rel="stylesheet">
	 <!-- Favicon Icon -->
	 <link rel="icon" type="image/png" sizes="16x16" href="/images/favicon.png">
	<style>
		.login-page > .content, .lock-page > .content {
			padding-top: 5vh;
		}
	</style>
</head>

<body data-gr-c-s-loaded="true" style="color:white">

    <nav class="navbar navbar-transparent navbar-absolute">
	    <div class="container">
	        <div class="navbar-header">
	            <button type="button" class="navbar-toggle navbar-toggle-black" data-toggle="collapse" data-target="#navigation-example-2">
	                <span class="sr-only">Toggle navigation</span>
	                <span class="icon-bar "></span>
	                <span class="icon-bar "></span>
	                <span class="icon-bar"></span>
	            </button>
	        </div>
	        <div class="collapse navbar-collapse">

	        </div>
	    </div>
	</nav>

    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="./login_files/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
        	<div class="content">
            	<div class="container">
                	<div class="row">
                    	<div class="col-md-8 col-md-offset-2">
                        	<div class="header-text">
							<a ><img src="https://www.alphaeworld.com/assets/logo2.png" class="card-footer text-center style=" text-align:="" margin:="" width:="" style="width: 100px;margin-left: 35%;"></a>
                            	<hr>
                        	</div>
						</div>
						<?php if ($count == 1) {?>
                    	<div class="col-md-4 col-md-offset-2">
                        	<div class="media">
                            	<div class="media-left">
                                	<div class="icon icon-danger">
                                    	<i class="ti ti-user" style="font-size: 3em;"></i>
                                	</div>
                            	</div>
                            	<div class="media-body">
                                	<h5>Investment Advice</h5>
                                	We offer consulting services in Stock Exchange and Forex for individual / businesses using expert adviser's
                            	</div>
                        	</div>
                        	<div class="media">
                            	<div class="media-left">
                                	<div class="icon icon-warning">
                                    	<i class="ti-bar-chart-alt" style="font-size: 3em;"></i>
                                	</div>
                            	</div>
                            	<div class="media-body">
                                	<h5>Awesome Return</h5>
                                	Earn money through our affiliate program. 
                            	</div>
                        	</div>
                        	<div class="media">
                            	<div class="media-left">
                                	<div class="icon icon-info">
                                    	<i class="ti-headphone" style="font-size: 3em;"></i>
                                	</div>
                            	</div>
                            	<div class="media-body">
                                	<h5>Professional Team</h5>
                                	We are team of professional traders in Stock Exchange and Share trading who know how to grab the profit end of the day. 
                            	</div>
                        	</div>
                    	</div>
                    	<div class="col-md-4">
                        	<form method="POST" action="/VerifyUser">
                            	<div class="card card-plain">
                                	<div class="content">
                                    	<div class="form-group">
                                        	<input required type="text" placeholder="Your First Name" class="form-control" name='firstname' value="<?php echo $firstname; ?>">
                                    	</div>
                                    	<div class="form-group">
                                        	<input required type="text" placeholder="Your Last Name" class="form-control" name='lastname' value="<?php echo $lastname; ?>">
                                    	</div>
                                    	<div class="form-group">
                                        	<input type="number" placeholder="Mobile" id="usermobile" class="form-control" name='mobile' value="<?php echo $mobile; ?>">

											<input required type="hidden" placeholder="Mobile" id="countrycode" class="form-control" name='countrycode' value="<?php echo $countrycode; ?>">										</div>
                                    	<div class="form-group">
											<input required type="email" placeholder="Enter email" class="form-control" name='email' value="<?php echo $email; ?>">
											<input required type="hidden" name='referalcode' value="<?php echo $referalcode; ?>">
											<input required type="hidden" name='token' value="<?php echo $unique; ?>">
										</div>
										<div class="form-group">
										<input required required class="form-control placeholder-no-fix" minlength="5" maxlength="15" type="text" autocomplete="off" placeholder="Username" name="username" id="username" onBlur="checkAvailability()" />
										<?php
										$show="display:none;";
if ($_REQUEST['data'] == "usernametaken") {
    $show="display:block;";
}
	?>
	<p style='color: #9c3333;<?php echo $show; ?>' id='ssssss' >Please Select another Username</p>
									</div>


                                    	<div class="form-group">
                                        	<input required type="password" placeholder="Password" class="form-control" id='password' name="password">
                                    	</div>
                                    	<div class="form-group">
											<input required type="password" placeholder="Password Confirmation" class="form-control"  id='repassword' name="repassword"  onkeyup ='check();' >
											<span id='message'></span>
											<script>

												var check = function() {
												if (document.getElementById('password').value==
												document.getElementById('repassword').value) {
												document.getElementById('message').innerHTML = '';

												} else{
													document.getElementById('message').innerHTML = 'Not Matching';
												document.getElementById('message').style.color = 'Red';
												}
												}

											</script>



										</div>
										<div class="form-group form-check">
											<input required type="checkbox" class="form-check-input" id="exampleCheck1">
											<label class="form-check-label" for="exampleCheck1" style="    color: white;">I agree to <a style="    color: white;" href="/TermsCondition">Terms & Conditions</a></label>
										</div>
                                	</div>
                                	<div class="footer text-center">
                                    	<button type="submit" class="btn btn-fill btn-danger btn-wd">Create Account</button>
                                	</div>
                            	</div>
							</form>

						</div>
				<?php } else {?>
					<div class="col-md-8 col-md-offset-2" style="text-align: center;">
					<h5>Your Invitation has expired</h5>
					Kindly write your query to support@alphaeworl.com
						</div>
					<?php }?>
                	</div>
            	</div>
        	</div>

    		<footer class="footer footer-transparent">
            	<div class="container">
                	<div class="copyright text-center"> ©2019, Alpha Exchange World DOO Požarevac</div>
            	</div>
        	</footer>
			<div class="full-page-background" style="background-image: url(./login_files/background-2.jpg) "></div></div>
	</div>


	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="./registration_files/jquery.min.js" type="text/javascript"></script>
	<script src="./registration_files/jquery-ui.min.js" type="text/javascript"></script>
	<script src="./registration_files/perfect-scrollbar.min.js" type="text/javascript"></script>
	<script src="./registration_files/bootstrap.min.js" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="./registration_files/jquery.validate.min.js"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="./registration_files/es6-promise-auto.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="./registration_files/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="./registration_files/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="./registration_files/bootstrap-selectpicker.js"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="./registration_files/bootstrap-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
	<script src="./registration_files/jquery.easypiechart.min.js"></script>

	<!--  Charts Plugin -->
	<script src="./registration_files/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="./registration_files/bootstrap-notify.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="./registration_files/sweetalert2.js"></script>

	<!-- Vector Map plugin -->
	<script src="./registration_files/jquery-jvectormap.js"></script>

	<!--  Google Maps Plugin    -->
	<script src="./registration_files/js"></script>

	<!-- Wizard Plugin    -->
	<script src="./registration_files/jquery.bootstrap.wizard.min.js"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="./registration_files/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="./registration_files/jquery.datatables.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="./registration_files/fullcalendar.min.js"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="./registration_files/paper-dashboard.js"></script>

	<!--   Sharrre Library    -->
    <script src="./registration_files/jquery.sharrre.js"></script>
	<script src="../tel/intlTelInput.js"></script>

	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="./registration_files/demo.js"></script>

	<script type="text/javascript">
        $(document).ready(function(){
            demo.checkFullPageBackgroundImage();

            setTimeout(function(){
                // after 1000 ms we add the class animated to the login/register card
                $('.card').removeClass('card-hidden');
            }, 700)
		});
	</script>
<script>
  $(document).ready(function(){
    var hash = location.hash.substr(1);


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

  });
  var value1;
  </script>

<script type="text/javascript">
        var uniqueuser=1;
        function checkAvailability()
        {
            var string = $('#username').val();
            $('#username').val(string.split(' ').join(''));
            $.post( "/UniqueUser", { userid:$('#username').val()})
        .done(function( data ) {
            //$("#inname").val('');$("#inuemail").val('');$("#inmobile").val('')
            //$("#addcontent").html(data);
            uniqueuser = parseInt(data);
            if (uniqueuser==1)
            {
				$("#ssssss").show();
                $('#username').css("border","1px solid red");
            }else {
				$("#ssssss").hide();
                $('#username').css("border","1px solid #6ba3c8");
            }

        });
        }
		</script>

<script src="./login_files/demo.js"></script>

<script type="text/javascript">
	$().ready(function(){
		demo.checkFullPageBackgroundImage();

		setTimeout(function(){
			// after 1000 ms we add the class animated to the login/register card
			$('.card').removeClass('card-hidden');
		}, 700)
	});
</script>

</body></html>