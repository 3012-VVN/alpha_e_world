<?php

session_start();
$card_number = str_replace(" ", "", $_POST['cardnumber']);
$card_exp = $_POST['card_exp'];
$arr = explode("/", $card_exp);
$card_cvv22 = trim($_POST['card_cvv']);

$host = "localhost";
$username = "alpha";
$password = "Bhagat@1982";
$dbname = "alphaeworld";

$con = mysqli_connect($host, $username, $password, $dbname);

/*exit;
$card_number = "4111111111111111";
$card_exp = "01/2020";
$arr = explode("/", $card_exp);
$card_cvv22 = "000";

$holdername = "Santosh Bhagat";*/

$arr1 = explode(" ", $_POST['holdername']);

$curl = curl_init();

$email = "santoshbhagat82@gmail.com";
$CLIENT_PASS = "x4HXvR82wD9RV2Awyz2wFJ9h7CCw94zj";

$key = md5(strtoupper(strrev($email) . $CLIENT_PASS . strrev(substr($card_number, 0, 6) . substr($card_number, -4))));

$order_id = $_POST['order_id'];
//$key = hash('ripemd160', 'The quick brown fox jumped over the lazy dog.');

$params = array("action" => "SALE", "async" => "N", "client_key" => "61VQK2D63R", "order_id" => $order_id, "order_amount" => "45.00", "order_currency" => "EUR", "order_description" => "Test Trsaction", "req_token" => "N", "card_number" => $card_number, "card_exp_month" => trim($arr[0]), "card_exp_year" => trim($arr[1]), "card_cvv22" => $card_cvv22, "payer_first_name" => trim($arr1[0]), "payer_last_name" => trim($arr1[1]), "payer_address" => "Malad East", "payer_country" => "IN", "payer_state" => "Maharashtra", "payer_city" => "Mumbai", "payer_zip" => "400097", "payer_email" => $email, "payer_phone" => "9221735735", "payer_ip" => "127.0.0.1", "term_url_3ds" => "https://www.alphaeworld.com/PaymentResponse", "recurring_init" => "N", "auth" => "N", "hash" => $key);

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
    //echo $response;

    $data = json_decode($response);
    //echo $data->result;
    if ($data->result == "REDIRECT") {
        //header('Location: ' . $data->redirect_url);
        $trans_id = $data->trans_id;
        $secure = '3d';
        $cs = substr($card_number, 0, 6);
        $cf = strtoupper(strrev($email) . $CLIENT_PASS . strrev(substr($card_number, 0, 6) . substr($card_number, -4)));
        echo $update = "UPDATE `payment` SET `trans_id` = '$trans_id',`secure`='$secure',`cs`='$key',`cf`='$cf' WHERE `payment`.`ID` = " . $_SESSION['order_id'];
        mysqli_query($con, $update);

        ?>
<form name="myform" action="<?php echo $data->redirect_url; ?>" method="POST">
    <input type="hidden" name="PaReq" value="<?php echo $data->redirect_params->PaReq; ?>">
    <input type="hidden" name="TermUrl" value="<?php echo $data->redirect_params->TermUrl; ?>">
</form>

<script type="text/javascript">
function submitform() {
    document.myform.submit();
}

submitform()
</script>

<?php
} else if ($data->result == "DECLINED") {
        //echo $data->result;
        if ($_SESSION['payid'] == 2) {
            header('Location: https://www.alphaeworld.com/TopUp?payment=DECLINED');
        }
    } else if ($data->result == "ERROR") {
        //echo $data->result;
        if ($_SESSION['payid'] == 2) {
            header('Location: https://www.alphaeworld.com/TopUp?payment=ERROR&ss=' . $data->error_message);
        }
    } else if ($data->result == "SUCCESS") {
        //echo $data->result;
        if ($_SESSION['payid'] == 2) {
            header('Location: https://www.alphaeworld.com/TopUp?payment=SUCCESS&trans_id=' . $data->trans_id);
        }
    }

    echo $data->result;
}