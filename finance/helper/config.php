<?php
include "check.php";

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
date_default_timezone_set('Asia/Kolkata');