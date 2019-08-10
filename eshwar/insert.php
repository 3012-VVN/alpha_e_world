<?php

$host="13.126.68.239";
$user="root";
$pass="Indi@1982";
$bddata="Eshwar";
$con = mysqli_connect($host,$user,$pass,$bddata);

if ($con){
    echo "connected";
}else{
    echo "not conneccted";
}

if ($_POST["submit"]){
    $username =$_POST["username"];
    $password =$_POST["password"];
    $mobile    =$_POST["mobile"];
    $Email     =$_POST["Email"];

    $query = "INSERT INTO `Users`(`ID`, `FirstName`, `LastName`, `mobile`, `email`) 
    VALUES ('',$username,$password,$mobile,$Email )";

    $result = mysqli_query($con,$query);
}
?>