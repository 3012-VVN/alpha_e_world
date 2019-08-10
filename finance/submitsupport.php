<?php

include "helper/header.php";
include "helper/config.php";

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

$email = $_SESSION['userid'];

$subject = $_REQUEST['subject'];
$body = $_REQUEST['query'];

$email = $_SESSION['userid'];

$checksql = "Select * from Users where `ID`='$email'";
$checkrst = mysqli_query($con, $checksql);
$UserInfo = mysqli_fetch_assoc($checkrst);

$subject1 = mysqli_real_escape_string($con, $_REQUEST['subject']);
$body1 = mysqli_real_escape_string($con, $_REQUEST['query']);

if (isset($_REQUEST['replyid'])) {

    $rid = $_REQUEST['replyid'];
    echo $checksql = "SELECT email,subject FROM `support` JOIN Users on Users.ID=support.userid where support.`ID`='$rid'";
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
        $mail->Subject = "Re:" . $UserInfo1['subject'];
        $mail->Body = $_REQUEST['reply'];
        $mail->AltBody = '';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
    header('Location: AdminSupport#success');

} else {
    $sql = "INSERT INTO `support` (`ID`,`userid`, `subject`, `query`, `date`,`joinid`) VALUES (NULL,'$email', '$subject1', '$body1', now(),'" . $UserInfo['joinid'] . "');";
    mysqli_query($con, $sql);
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
        $mail->addAddress($UserInfo['email']); // Add a recipient
        //$code = 'A00'.$email."&token=".$uni;
        //$body = "You have been invited to join Alpha Exchange World.<br><a href='https://www.alphaeworld.com/Registration?referalcode=$code'>Click here to join</a>";

        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AltBody = '';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }

    header('Location: Support#success');
}