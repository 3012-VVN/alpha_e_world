<?php

include "helper/header.php";
include "helper/config.php";

$email = $_REQUEST['uid'];

$checksql = "SELECT * FROM `kycdetailsapproval` where userid='$email' and status=0";
$checkrst = mysqli_query($con, $checksql);
$tokenrow = mysqli_fetch_assoc($checkrst);
$rowcount = mysqli_num_rows($checkrst);

?>

<table style="width:100%">
  <tr>
    <th>Title</th>
    <th>Data</th>
  </tr>
  <tr>
    <td style="font-weight: bold;">PAN Card</td>
    <td><?php echo $tokenrow['pancard'];?></td>
    
  </tr>
  <tr>
    <td style="font-weight: bold;">Aadhar Card</td>
    <td><?php echo $tokenrow['adharcard'];?></td>
  </tr>

  <tr>
    <td style="font-weight: bold;">Bank Name</td>
    <td><?php echo $tokenrow['bankname'];?></td>
  </tr>
  <tr>
    <td style="font-weight: bold;">Account No.</td>
    <td><?php echo $tokenrow['accno'];?></td>
  </tr>
  <tr>
    <td style="font-weight: bold;">IFSC Code</td>
    <td><?php echo $tokenrow['ifsccode'];?></td>
  </tr>
</table>
