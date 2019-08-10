<?php
$con = mysqli_connect("localhost", "root", "Indi@1982", "test");

// Check connection
if (mysqli_connect_errno()) {
   // echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //die;
}

//echo "Connected";
phpinfo();