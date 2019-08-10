<?php

if ($email == 1 || $email == 2) {
    $checksql = "Select * from inviteuser  where `joinid`='$email'";
} else {
    $checksql = "Select * from inviteuser where `userid`='$email' and `joinid`='$email'";
}

$checkrst = mysqli_query($con, $checksql);
$li = "";
while ($tokenrow = mysqli_fetch_assoc($checkrst)) {
    $unique = $tokenrow['unique'];
    if ($tokenrow['status'] == 0) {
        $open = "fa-envelope";
        $osol = "text-muted";
        $omsg = "Offline";
    } else if ($tokenrow['status'] == 1) {
        $open = "fa-envelope-open";
        $osol = "text-danger";
        $omsg = "Messaged Open";
    } else if ($tokenrow['status'] == 2) {
        $open = "fa-envelope-open";
        $osol = "text-warning";
        $omsg = "User Registered Verification Pending";
    } else if ($tokenrow['status'] == 3) {
        $open = "fa-envelope-open";
        $osol = "text-warning";
        $omsg = "Admin Verification Pending";
    } else if ($tokenrow['status'] == 4) {
        $open = "fa-link";
        $osol = "text-success";
        $omsg = "Joined";
    }
    $li .= '<li>
    <div class="row">
      <div class="col-md-2 col-2">
        <div class="avatar">
          <img src="/assets/img/male.png" alt="Circle Image" class="img-circle img-no-padding img-responsive">
        </div>
      </div>
      <div class="col-md-7 col-7">
        ' . $tokenrow['name'] . '
        <br>
        <span class="' . $osol . '">
          <small>' . $omsg . '</small>
        </span>
      </div>
      <div class="col-md-3 col-3 text-right">
        <a href="/TradeBuddies?uid=' . $unique . '" ><btn class="btn btn-sm btn-outline-success btn-round btn-icon"><i class="fa ' . $open . '"></i></btn></a>
      </div>
    </div>
  </li>';
}

?>
<ul class="list-unstyled team-members">
    <?php echo $li; ?>
</ul>