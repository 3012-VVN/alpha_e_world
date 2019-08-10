<?php include "check.php";

require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;
if (isset($_POST['uname']) && isset($_POST['uemail']) && isset($_POST['umobile']) && isset($_POST['message'])) {

    $subject = "Website Join Request";
    $toemail = 'support@alphaeworld.com';

    $body = " Request Form<br> Name:" . $_POST['uname'] . "<br>Email:" . $_POST['uemail'] . "<br>Mobile:" . $_POST['umobile'] . "<br>Message:" . $_POST['message'];

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
    header('Location: index.php?submitted=1');
} else {
    header('Location: index.php?submitted=0');
}

//echo "User Document Approved";