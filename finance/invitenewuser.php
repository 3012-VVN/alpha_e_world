<?php

include "helper/header.php";
include "helper/config.php";

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = $_SESSION['userid'];

if (filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {

} else {
    header('Location: InviteUser#invalidemail');
}

$checksql = "Select * from inviteuser where `email`='" . $_REQUEST['email'] . "'";
$checkrst = mysqli_query($con, $checksql);
$tokenrow = mysqli_fetch_assoc($checkrst);
$rowcount = mysqli_num_rows($checkrst);

$checksql = "Select * from inviteuser where `mobile` = '" . $_REQUEST['mobile'] . "'";
$checkrst1 = mysqli_query($con, $checksql);
$tokenrow1 = mysqli_fetch_assoc($checkrst1);
$rowcount1 = mysqli_num_rows($checkrst1);

if (isset($_REQUEST['email']) && $_REQUEST['email'] != "" && isset($_REQUEST['mobile']) && $_REQUEST['mobile'] != "") {
    if ($rowcount >= 5 || $rowcount1 >= 5) {
        header('Location: InviteUser#alreadymember');
    } else {
        $uni = uniqid();

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
            $mail->Password = 'Serb@i@2019'; // SMTP password
            $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
            $mail->Port = 587; // TCP port to connect to

            //Recipients
            $mail->setFrom('support@alphaeworld.com', 'Alpha Exchange World');
            $mail->addAddress($toemail); // Add a recipient
            $code = 'A00' . $email . "&token=" . $uni;
            $body = "You have been invited to join Alpha Exchange World.<br><a href='https://www.alphaeworld.com/Registration?referalcode=$code'>Click here to join</a>";

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = 'Invite To join Alpha Exchange World';
            $mail->Body = $body;
            $mail->AltBody = '';

            $mail->send();
            //echo 'Message has been sent';
            header('Location: InviteUser#success');
            $joinid = $_SESSION['joinid'];
            $checksql = "INSERT INTO `inviteuser` (`ID`, `userid`, `name`, `email`, `mobile`,`countrycode`,`unique`,`status`,`joinid`) VALUES (NULL, '$email', '" . $_REQUEST['name'] . "', '" . $_REQUEST['email'] . "', '" . $_REQUEST['mobile'] . "','" . $_REQUEST['countrycode'] . "','$uni',0, $joinid);";
            $checkrst = mysqli_query($con, $checksql);

        } catch (Exception $e) {
            //echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
            header('Location: InviteUser#failed');
        }

        header('Location: InviteUser#success');
    }
}