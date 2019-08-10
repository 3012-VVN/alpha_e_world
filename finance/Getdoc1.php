<?php

include "helper/header.php";
include "helper/config.php";

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = $_SESSION['userid'];

if (isset($_REQUEST['uid1'])) {
    $email1 = $_REQUEST['uid1'];
    $checksql = "SELECT * FROM `Users` where `ID`='$email1'";
    $checkrst = mysqli_query($con, $checksql);
    $UserInfo1 = mysqli_fetch_assoc($checkrst);

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
        $mail->addAddress($UserInfo1['email']); // Add a recipient
        //$code = 'A00'.$email."&token=".$uni;
        //$body = "You have been invited to join Alpha Exchange World.<br><a href='https://www.alphaeworld.com/Registration?referalcode=$code'>Click here to join</a>";

        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "Resubmit transaction detail's.";
        $mail->Body = "The submitted transaction details are incorrect, kindly resubmit transaction detail's with proper transaction number and date. For Userid: ".$UserInfo1['username'];
        $mail->AltBody = '';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
} else {
    $email1 = $_REQUEST['uid'];
    $st = 1;
    if (isset($_REQUEST['status'])) {
        $st = 3;

        $checksql = "SELECT * FROM `Users` where `ID`='$email1'";
        $checkrst = mysqli_query($con, $checksql);
        $UserInfo1 = mysqli_fetch_assoc($checkrst);

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
            $mail->addAddress($UserInfo1['email']); // Add a recipient
            //$code = 'A00'.$email."&token=".$uni;
            //$body = "You have been invited to join Alpha Exchange World.<br><a href='https://www.alphaeworld.com/Registration?referalcode=$code'>Click here to join</a>";

            $mail->isHTML(true); // Set email format to HTML
            $mail->Subject = "Resubmit Document's.";
            $mail->Body = "The Submitted documents are not proper, kindly resubmit the document's. For Userid: ".$UserInfo1['username'];
            $mail->AltBody = '';

            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
        }
    }

    $checksql = "UPDATE `kycdetails` SET `status`='$st' where userid='$email1'";

    $checkrst = mysqli_query($con, $checksql);
    $inviteuser = mysqli_fetch_assoc($checkrst);

    //echo "User Document Approved";
}
