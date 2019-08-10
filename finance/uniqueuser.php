<?php

include "helper/config.php";

$username = strtoupper($_REQUEST['userid']);

$checksql = "Select * from Users where `username` = '$username'";
$checkrst = mysqli_query($con, $checksql);
echo $rowcount = mysqli_num_rows($checkrst);
