<?php

//include "helper/header.php";
//include "helper/config.php";

$host = "localhost";
$username = "alpha";
$password = "Bhagat@1982";
$dbname = "alphaeworld";

$con = mysqli_connect($host, $username, $password, $dbname);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

session_start();
//echo $_SESSION['otp'];
$attempt = intval($_SESSION['attempt']);
if ($_SESSION['otp'] == $_REQUEST['otp'] && $attempt < 4) {
    $joinkey = $_SESSION['userid1'];

    echo $sql = "UPDATE `Users` SET `IsActive`='1' where `ID`='$joinkey'";
    mysqli_query($con, $sql);

    $_SESSION['logged'] = "logged";
    $_SESSION['userid'] = $_SESSION['userid1'];
    header('Location: Login');

} else {
    $attempt++;
    $_SESSION['attempt'] = $attempt;
    header('Location: VerifyUser?otp=failed');
}