<?php

//include "helper/header.php";
include "helper/config.php";

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_REQUEST['otp'])) {
} else {

	if (isset($_REQUEST['firstname'])&& isset($_REQUEST['lastname'])&& isset($_REQUEST['email'])&& isset($_REQUEST['mobile'])&& isset($_REQUEST['token'])&& isset($_REQUEST['countrycode'])&& isset($_REQUEST['referalcode'])&& isset($_REQUEST['password'])&& isset($_REQUEST['repassword']))
	{

	}else {
		echo "Somethings went wrong kindly contact administrator";
		die();
	}
	session_start();
	$username = strtoupper($_REQUEST['username']);

    $checksql = "Select * from `Users` where `username`='$username'";
    $checkrst = mysqli_query($con, $checksql);
    $count = mysqli_num_rows($checkrst);
    if ($count == 0) {
        //if ($_SESSION['username'] == $username) {
        $_title .= " Verify User";

        $otp = '';
        
        for ($i = 0; $i < 4; $i++) {
            $otp .= rand(1, 9);
        }
        //var_dump($_REQUEST);
        $mobile = $_REQUEST['countrycode'] . $_REQUEST['mobile'];
        //to be commented
        //$msg = ($otp . "%20is%20the%20OTP%20for%20your%20mobile%20verification%20on%20Alpha%20Exchang%20World,%20User%20ID:" . $username);
        //$uel = "http://priority.thesmsworld.com/api.php?username=procap&password=324947&sender=Alpha&sendto=" . $mobile . "&message=" . $msg;
        //echo $uel;
        //file_get_contents($uel);

        $toemail = $_REQUEST['email'];

        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        try {
            //Server settings
            //Server settings
            $mail->SMTPDebug = 0; // Enable verbose debug output
            $mail->isSMTP(); // Set mailer to use SMTP
            $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
            $mail->SMTPAuth = true; // Enable SMTP authentication
            $mail->Username = 'support@alphaeworld.com'; // SMTP username
            $mail->Password = 'Mumb@i@2019'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('support@alphaeworld.com', 'Alpha Exchange World');
            $mail->addAddress($toemail); // Add a recipient
            $code = 'A00' . $email . "&token=" . $uni;
            $body = $otp . " is the OTP for verification on Alpha Exchange World, User ID:" . $username;

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Verification OTP';
            $mail->Body = $body;
            $mail->AltBody = '';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        if (isset($_REQUEST['token'])) {
            $unique = $_REQUEST['token'];
            $checksql = "Select * from inviteuser where `unique`='$unique'";
            $checkrst = mysqli_query($con, $checksql);
            $inviteuser = mysqli_fetch_assoc($checkrst);

            if ($inviteuser['status'] == 1) {
                $sql = "Update inviteuser set status=2 where `unique`='$unique'";
                mysqli_query($con, $sql);
            }
        }

        //$otp='1234';;
        $checksql = "INSERT INTO `Users` (`ID`, `firstname`, `middlename`, `lastname`, `dateofbirth`, `gender`, `email`, `mobile`, `country`, `city`, `pincode`, `address`, `aboutme`, `username`, `password`, `rpassword`, `tnc`, `otp`, `step`, `plan`, `createddate`, `profileurl`, `joindate`, `referalcode`,`joinkey`) VALUES (NULL, '" . $_REQUEST['firstname'] . "', '', '" . $_REQUEST['lastname'] . "', '', '', '" . $_REQUEST['email'] . "', '$mobile', '', '', '', '', '', '$username', '" . $_REQUEST['password'] . "', '" . $_REQUEST['repassword'] . "', '1', '$otp', '0','0',  now(), 'assets/img/male.png', now(), '" . $_REQUEST['referalcode'] . "','" . $_REQUEST['token'] . "');";
        $checkrst = mysqli_query($con, $checksql);
        $inviteuser = mysqli_fetch_assoc($checkrst);

        $last_id = mysqli_insert_id($con);

        $_SESSION['username'] = $username;
		$_SESSION['userid1'] = $last_id;
		$_SESSION['email'] = $_REQUEST['email'];
        $_SESSION['otp'] = $otp;
        $_SESSION['attempt'] = 0;
    } else {
        if ($_SESSION['username']!="") {
			if ($_REQUEST['resend']==1)
			{
				//var_dump($_REQUEST);
				//$mobile = $_REQUEST['countrycode'] . $_REQUEST['mobile'];
				//to be commented
				//$msg = ($otp . "%20is%20the%20OTP%20for%20your%20mobile%20verification%20on%20Alpha%20Exchang%20World,%20User%20ID:" . $username);
				//$uel = "http://priority.thesmsworld.com/api.php?username=procap&password=324947&sender=Alpha&sendto=" . $mobile . "&message=" . $msg;
				//echo $uel;
				//file_get_contents($uel);

				$otp = '';
        
        for ($i = 0; $i < 4; $i++) {
            $otp .= rand(1, 9);
        }
		
				$toemail = $_SESSION['email'];
		
				$mail = new PHPMailer(true); // Passing `true` enables exceptions
				try {
					//Server settings
					//Server settings
					$mail->SMTPDebug = 0; // Enable verbose debug output
					$mail->isSMTP(); // Set mailer to use SMTP
					$mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
					$mail->SMTPAuth = true; // Enable SMTP authentication
					$mail->Username = 'support@alphaeworld.com'; // SMTP username
					$mail->Password = 'Mumb@i@2019'; // SMTP password
					$mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
					$mail->Port = 587; // TCP port to connect to
		
					//Recipients
					$mail->setFrom('support@alphaeworld.com', 'Alpha Exchange World');
					$mail->addAddress($toemail); // Add a recipient
					$code = 'A00' . $email . "&token=" . $uni;
					$body = $otp . " is the OTP for verification on Alpha Exchange World, User ID:" . $username;
		
					$mail->isHTML(true); // Set email format to HTML
					$mail->Subject = 'Verification OTP';
					$mail->Body = $body;
					$mail->AltBody = '';
		
					$mail->send();
					//echo 'Message has been sent';
				} catch (Exception $e) {
					//echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
				}
		
				$sql = "UPDATE `Users` SET `otp`='$otp' where `username`='$username'";
				mysqli_query($con, $sql);
			}
		}else{
            header('Location: Registration?referalcode=' . $_REQUEST['referalcode'] . '&token=' . $_REQUEST['token'] . '&data=usernametaken');
        }
    }
    //}
}
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


    <!--  Fonts and icons     -->
    <link href="./registration_files/font-awesome.min.css" rel="stylesheet">
    <link href="./registration_files/css" rel="stylesheet" type="text/css">
	<link href="./registration_files/themify-icons.css" rel="stylesheet">
	<link rel="apple-touch-icon" sizes="57x57" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/3eda1462582fcc53eefc9f2d43830b29/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/3eda1462582fcc53eefc9f2d43830b29/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/3eda1462582fcc53eefc9f2d43830b29/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/3eda1462582fcc53eefc9f2d43830b29/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/3eda1462582fcc53eefc9f2d43830b29/favicon-16x16.png">
	<link rel="manifest" href="/3eda1462582fcc53eefc9f2d43830b29/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>

<body data-gr-c-s-loaded="true" style="background-image:url?(https://www.alphaeworld.com/finance/login_files/background-2.jpg);    background-repeat: no-repeat;
    background-position: 100% 100%;
    background-size: cover;
    color: #fff;">

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
	            <ul class="nav navbar-nav navbar-right">
	                <li>
	                   <a href="login.php" class="btn">
	                        Looking to login?
	                    </a>
	                </li>
	            </ul>
	        </div>
	    </div>
	</nav>

	
    <div class="wrapper wrapper-full-page">
        <div class="full-page login-page" data-color="" data-image="./login_files/background/background-2.jpg">
        <!--   you can change the color of the filter page using: data-color="blue | azure | green | orange | red | purple" -->
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-md-offset-4 col-sm-offset-3">
                        <a herf="/"><img src="https://www.alphaeworld.com/assets/logo2.png" class="card-footer text-center style=" text-align:="" margin:="" width:="" style="width: 100px;margin-left: 35%;margin-bottom: 18px;"></a>
						<p style="    text-align: center;">Verification Emailer and OTP will be sent to you provided Email Address and Mobile in next 10 mintues.</p>
							<form method="POST" action="/VerifyOTP">
								<div class="card card-plain">
                                	<div class="content" style="width: 400px;margin: 0 auto 25px;">
                                    	<div class="form-group">
                                        	<input type="text" placeholder="Enter OTP" name='otp' class="form-control">
                                    	</div>

                                	</div>
                                	<div class="footer text-center">
                                    	<button type="submit" class="btn btn-fill btn-danger btn-wd">Verify Me</button>
                                	</div>
                            	</div>
							</form>
							<hr>
							<a href="/VerifyUser?resend=1"><p style="text-align: center;">Resend OTP</p></a>
							<p></p>
                        </div>
                    </div>
                </div>
            </div>

        	<footer class="footer footer-transparent">
                <div class="container">
                <div class="copyright text-center"> ©2019, Alpha Exchange World</div>
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


	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="./registration_files/demo.js"></script>

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