<?php

include "helper/header.php";
include "helper/config.php";

$email = $_SESSION['userid'];

$update = "SELECT * from `payment` WHERE `ID` = " . $_SESSION['order_id'];
$checkrst1 = mysqli_query($con, $update);
$rowcount1 = mysqli_num_rows($checkrst1);
$UserBankInfo1 = mysqli_fetch_assoc($checkrst1);
//print_r($UserBankInfo1);
$curl = curl_init();

$email = "santoshbhagat82@gmail.com";
$CLIENT_PASS = "x4HXvR82wD9RV2Awyz2wFJ9h7CCw94zj";

$key = ($UserBankInfo1['cs']);
$order_id = $_POST['order_id'];

$params = array("action" => "GET_TRANS_DETAILS", "client_key" => "61VQK2D63R", "trans_id" => $UserBankInfo1['trans_id'], "hash" => $key);
//echo http_build_query($params);

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://secure.payinspect.com/post/",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => http_build_query($params),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    echo $response;
}
if ($_SESSION['payid'] == 2) {
    header('Location: https://www.alphaeworld.com/TopUp?payment=SUCCESS&trans_id=' . $UserBankInfo1['trans_id']);
} else {
    header('Location: https://www.alphaeworld.com/Dashboard?payment=SUCCESS&trans_id=' . $UserBankInfo1['trans_id']);
}