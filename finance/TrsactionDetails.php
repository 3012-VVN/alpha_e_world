<?php
 $data = file_get_contents("php://input");
 $events = json_decode($data, true);

 $json_string = "All Post Data JUNK";
 $json_string .= json_encode($_REQUEST);

 $payment = json_decode(($_REQUEST), true);
 echo $payment['result'];
 echo $payment['order']['id'];
 echo $payment['transaction']['receipt'];

 $json_string .= "Input Data";
 $json_string .= json_encode($data);
 $json_string .= "Header info";
 $json_string .= json_encode($_SERVER);
 $json_string .= "All ReQUEST info";
 $json_string = print_r($_REQUEST, TRUE);

 //echo $json_string;

 $fp = fopen("pg/" . uniqid() . date('Y-m-d_h:i:s') . '.json', 'w');
 fwrite($fp, json_encode($json_string));
 fclose($fp);
