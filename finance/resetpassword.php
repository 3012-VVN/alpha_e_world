<?php

include "helper/header.php";
include "helper/config.php";

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = $_SESSION['userid'];



$err = 0;
if (isset($_REQUEST['seceret'])) {
    $checksql = "Select * from Users where `email`='" . $_SESSION['remail'] . "' and secret='".$_REQUEST['seceret']."'";
    $checkrst = mysqli_query($con, $checksql);
    $tokenrow = mysqli_fetch_assoc($checkrst);
    $rowcount = mysqli_num_rows($checkrst);

    if ($_REQUEST['password'] == $_REQUEST['repassword']) {
        if ($rowcount>0)
        {
            $ID = $tokenrow['ID'];

            $checksql = "UPDATE `Users` SET `password` = '".$_REQUEST['password']."' WHERE `Users`.`ID` = $ID;";
            $checkrst = mysqli_query($con, $checksql);
            header('Location: Login');
        }else {
            $err=2;
        }

    } else {
        $err = 1;
    }

} else if (isset($_REQUEST['email']) && $_REQUEST['email'] != "") {
    $_SESSION['remail']= $_REQUEST['email'];
 
    $checksql = "Select * from Users where `email`='" . $_REQUEST['email'] . "'";
    $checkrst = mysqli_query($con, $checksql);
    $tokenrow = mysqli_fetch_assoc($checkrst);
    $rowcount = mysqli_num_rows($checkrst);

    if ($rowcount > 0) {
        $uni = uniqid();
        $ID = $tokenrow['ID'];
        $checksql = "UPDATE `Users` SET `secret` = '$uni' WHERE `Users`.`ID` = $ID;";
        $checkrst = mysqli_query($con, $checksql);

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
            $body = "The Reset Code is " . $uni;

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Reset Password Code';
            $mail->Body = $body;
            $mail->AltBody = '';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }

        //header('Location: InviteUser#success');
    } else {
        header('Location: ForgotPassword#nouser2');
    }
} else {
    header('Location: ForgotPassword#nouser1');
}
?>
<!DOCTYPE html>

<html lang="en" class="perfect-scrollbar-off gr__demos_creative-tim_com">


<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title>
    Alpha Exchange World
  </title>


	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
    <meta name="viewport" content="width=device-width">


     <!-- Bootstrap core CSS     -->
    <link href="./login_files/bootstrap.min.css" rel="stylesheet">

    <!--  Paper Dashboard core CSS    -->
    <link href="./login_files/paper-dashboard.css" rel="stylesheet">


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="./login_files/demo.css" rel="stylesheet">


    <!--  Fonts and icons     -->
    <link href="./login_files/font-awesome.min.css" rel="stylesheet">
    <link href="./login_files/css" rel="stylesheet" type="text/css">
    <link href="./login_files/themify-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
</head>

<body data-gr-c-s-loaded="true">

    <nav class="navbar navbar-transparent navbar-absolute">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img src="../assets/img/logo-small.png" style="
    max-width: 100%;
    border-radius: 193px;
    float: left;
    width: 34px;
    margin-top: 21px;
">
<a class="navbar-brand" style="margin-left: 1px;" href="/">Alpha Exchange World</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>

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

                            <form method="POST" action="/ResetPassword">
                                <div class="card" data-background="color" data-color="blue">
                                    <div class="card-header">
                                        <h3 class="card-title">Enter Reset Code</h3>

                                    </div>
                                    <div class="card-content">
                                        <div class="form-group">
                                            <label>Secert Code</label>
                                            <input type="text" placeholder="Enter Secert Code" required name="seceret" class="form-control input-no-border">
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <input type="password" placeholder="" name='password' required class="form-control input-no-border">
                                        </div>
                                        <div class="form-group">
                                            <label>Re Password</label>
                                            <input type="password" placeholder="" name='repassword' required class="form-control input-no-border">
                                        </div>
                                    </div>
                                    <div class="card-footer text-center">
                                        <?php if ($err == 1) {
    ?>
                                        <p> Password dose not match/p>
                                        <?php
} elseif ($err == 2) {
    ?>
                                        <p> Invalid Secert code</p>
                                        <?php
}?>
                                        <button type="submit" class="btn btn-fill btn-wd ">Submit</button>
                                        <div class="forgot" style="    margin-top: 14px;">
                                            Not a member yet?<a href="/Registration">Create a account Here</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        	<footer class="footer footer-transparent">
                <div class="container">
                <div class="copyright text-center"> ©2019, FX Zone International</div>
                </div>
            </footer>
        <div class="full-page-background" style="background-image: url(./login_files/background-2.jpg) "></div></div>
    </div>


	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="./login_files/jquery.min.js" type="text/javascript"></script>
	<script src="./login_files/jquery-ui.min.js" type="text/javascript"></script>
	<script src="./login_files/perfect-scrollbar.min.js" type="text/javascript"></script>
	<script src="./login_files/bootstrap.min.js" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="./login_files/jquery.validate.min.js"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="./login_files/es6-promise-auto.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="./login_files/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="./login_files/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="./login_files/bootstrap-selectpicker.js"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="./login_files/bootstrap-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
	<script src="./login_files/jquery.easypiechart.min.js"></script>

	<!--  Charts Plugin -->
	<script src="./login_files/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="./login_files/bootstrap-notify.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="./login_files/sweetalert2.js"></script>

	<!-- Vector Map plugin -->
	<script src="./login_files/jquery-jvectormap.js"></script>

	<!--  Google Maps Plugin    -->
	<script src="./login_files/js"></script>

	<!-- Wizard Plugin    -->
	<script src="./login_files/jquery.bootstrap.wizard.min.js"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="./login_files/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="./login_files/jquery.datatables.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="./login_files/fullcalendar.min.js"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="./login_files/paper-dashboard.js"></script>

	<!--   Sharrre Library    -->
    <script src="./login_files/jquery.sharrre.js"></script>

	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
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