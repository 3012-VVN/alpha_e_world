<?php
session_start();

$_SESSION['logged']= "";
$_SESSION['username']="";

session_destroy();

header('Location: Login');